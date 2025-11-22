<?php

namespace App\Services;

use Exception;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\CalendarController;

class CalendarService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->initializeGoogleClient();
    }

    private function initializeGoogleClient()
    {
        $this->client = new Client();
        $this->client->setClientId(config('services.google.client_id'));
        $this->client->setClientSecret(config('services.google.client_secret'));
        $this->client->setRedirectUri(config('services.google.redirect'));
        $this->client->addScope(Calendar::CALENDAR);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');

        $user = Auth::user();
        if ($user && $user->google_token) {
            $this->client->setAccessToken(json_decode($user->google_token, true));

            // Rafraîchir le token si expiré
            if ($this->client->isAccessTokenExpired()) {
                $refreshToken = $this->client->getRefreshToken();
                if ($refreshToken) {
                    $this->client->fetchAccessTokenWithRefreshToken($refreshToken);
                    
                    $user->google_token = json_encode($this->client->getAccessToken());
                    $user->save();
                }
            }
        }

        $this->service = new Calendar($this->client);
    }

    public function redirect($provider)
    {
        if ($provider == 'google') {
            return Socialite::driver($provider)
                ->scopes(['https://www.googleapis.com/auth/calendar'])
                ->redirect();
        } else {
            return Socialite::driver($provider)->redirect();
        }
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            $user = Auth::user();
            if ($user) {
                $user->google_token = json_encode([
                    'access_token' => $socialUser->token,
                    'refresh_token' => $socialUser->refreshToken,
                    'expires_in' => $socialUser->expiresIn,
                    'created' => time()
                ]);
                $user->save();
            }

            // Réinitialiser le client avec le nouveau token
            $this->initializeGoogleClient();

            return true;
        } catch (Exception $e) {
            Log::error('Calendar Service Callback Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Récupérer les événements du calendrier principal
     */
    public function getEvents($maxResults = 10)
    {
        try {
            $calendarId = 'primary';
            $optParams = [
                'maxResults' => $maxResults,
                'orderBy' => 'startTime',
                'singleEvents' => true,
                'timeMin' => date('c'),
            ];

            $events = $this->service->events->listEvents($calendarId, $optParams)->getItems();
            return $events;
        } catch (Exception $e) {
            Log::error('Calendar Service Get Events Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupérer les événements de Google Calendar (compatible avec le contrôleur)
     */
    public function getGoogleCalendarEvents($maxResults = 10)
    {
        return $this->getEvents($maxResults);
    }

    /**
     * Ajouter un événement dans Google Calendar
     */
    public function addEvent($title, $startDateTime, $endDateTime, $description = null)
    {
        try {
            $event = new Event([
                'summary' => $title,
                'description' => $description,
                'start' => [
                    'dateTime' => $startDateTime,
                    'timeZone' => config('app.timezone'),
                ],
                'end' => [
                    'dateTime' => $endDateTime,
                    'timeZone' => config('app.timezone'),
                ],
            ]);

            $calendarId = 'primary';
            return $this->service->events->insert($calendarId, $event);
        } catch (Exception $e) {
            Log::error('Calendar Service Add Event Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Créer un événement Google Calendar avec un tableau de données (compatible avec le contrôleur)
     */
    public function createGoogleCalendarEvent($eventArray)
    {
        try {
            $event = new Event([
                'summary' => $eventArray['summary'] ?? '',
                'location' => $eventArray['Location'] ?? $eventArray['location'] ?? '',
                'description' => $eventArray['description'] ?? '',
                'start' => [
                    'dateTime' => $eventArray['start']['dateTime'],
                    'timeZone' => $eventArray['start']['timeZone'] ?? config('app.timezone'),
                ],
                'end' => [
                    'dateTime' => $eventArray['end']['dateTime'],
                    'timeZone' => $eventArray['end']['timezone'] ?? $eventArray['end']['timeZone'] ?? config('app.timezone'),
                ],
            ]);

            // Ajouter la récurrence si elle existe
            if (isset($eventArray['recurrence'])) {
                $event->setRecurrence($eventArray['recurrence']);
            }

            // Ajouter les participants si ils existent
            if (isset($eventArray['attendees'])) {
                $event->setAttendees($eventArray['attendees']);
            }

            $calendarId = 'primary';
            return $this->service->events->insert($calendarId, $event);
        } catch (Exception $e) {
            Log::error('Calendar Service Create Event Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Mettre à jour un événement
     */
    public function updateEvent($eventId, $eventData)
    {
        try {
            $event = $this->service->events->get('primary', $eventId);
            
            // Mettre à jour les propriétés de l'événement
            if (isset($eventData['summary'])) {
                $event->setSummary($eventData['summary']);
            }
            if (isset($eventData['description'])) {
                $event->setDescription($eventData['description']);
            }
            if (isset($eventData['start'])) {
                $event->setStart($eventData['start']);
            }
            if (isset($eventData['end'])) {
                $event->setEnd($eventData['end']);
            }

            return $this->service->events->update('primary', $eventId, $event);
        } catch (Exception $e) {
            Log::error('Calendar Service Update Event Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Supprimer un événement
     */
    public function deleteEvent($eventId)
    {
        try {
            return $this->service->events->delete('primary', $eventId);
        } catch (Exception $e) {
            Log::error('Calendar Service Delete Event Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Vérifier si l'utilisateur est authentifié avec Google
     */
    public function isAuthenticated()
    {
        $user = Auth::user();
        return $user && $user->google_token && !$this->client->isAccessTokenExpired();
    }
}