<?php

namespace App\Http\Controllers;
use App\Services\CalendarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
protected $calendarService;
public function _construct(){
$this->calendarService = new CalendarService;
}
public function createEvent(){
    $eventArray = [
        'summary' => 'Google Calendar Event',
        'Location' => '800 Howard St., San Fransisco , CA 94103',
        'description' => 'A chance to hear more about Google\'s developer products.',
        'start' => [
            'dateTime' =>'2024-09-28T09:00:00-07:00',
            'timeZone' => 'America/Los AngeLes',
        ],
        'end' => [
            'dateTime' => '2024-09-28T17:00:00-07:00',
            'timezone' => 'America/Los AngeLes'
        ],
        'recurrence' => [
            'RULE:FREQ=DAILY;COUNT=2'
        ],
        'attendees' => [
            ['email' => 'rihabktiti2023@gmail.com']
        ]
        ];
    return $this->calendarService->createGoogleCalendarEvent($eventArray);
}
public function getEvents(){
return $this->calendarService->getGoogleCalendarEvents();
}
public function redirect(){
return $this->calendarService->redirect(provider: 'google');
}
    public function redirectToGoogle()
    {
        try {
            $clientId = env('GOOGLE_CLIENT_ID');
            $clientSecret = env('GOOGLE_CLIENT_SECRET');
            $redirectUri = env('GOOGLE_REDIRECT_URI');

            if (empty($clientId)) {
                throw new \Exception('Configuration Google manquante');
            }

            $client = new \Google_Client();
            $client->setApplicationName(config('app.name'));
            $client->setClientId($clientId);
            $client->setClientSecret($clientSecret);
            $client->setRedirectUri($redirectUri);
            $client->addScope(\Google_Service_Calendar::CALENDAR);
            $client->setAccessType('offline');
            $client->setPrompt('consent');

            $authUrl = $client->createAuthUrl();
            
            return redirect($authUrl);

        } catch (\Exception $e) {
            return redirect()->route('veterinaire.calendar')
                ->with('error', 'Erreur: ' . $e->getMessage());
        }
    }

    public function handleGoogleCallback(Request $request)
    {
        // Votre code pour le callback
        return redirect()->route('veterinaire.calendar')
            ->with('success', 'Connecté avec succès!');
    }
}