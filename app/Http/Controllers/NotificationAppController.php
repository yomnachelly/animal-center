<?php

namespace App\Http\Controllers;

use App\Models\NotificationApp;
use Illuminate\Http\Request;

class NotificationAppController extends Controller
{
    public function index()
    {
        return NotificationApp::with('user')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'contenu' => 'required',
            'date' => 'required|date'
        ]);

        return NotificationApp::create($validated);
    }

    public function show($id)
    {
        return NotificationApp::with('user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $notif = NotificationApp::findOrFail($id);
        $notif->update($request->all());
        return $notif;
    }

    public function destroy($id)
    {
        NotificationApp::findOrFail($id)->delete();
        return ['message' => 'Notification supprimée'];
    }
}
