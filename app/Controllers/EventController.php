<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\UserEventModel;

class EventController extends BaseController
{
    public function index()
    {
        $eventModel = new EventModel();
        $data['events'] = $eventModel->findAll();
        return view('events/index', $data);
    }

    public function join($event_id)
    {
        $user_id = session()->get('user_id');
        $model = new UserEventModel();

        $model->insert([
            'user_id' => $user_id,
            'event_id' => $event_id
        ]);

        return redirect()->to('/events/confirm-join/' . $event_id);
    }

    public function confirmJoin($event_id)
    {
        $user_id = session()->get('user_id');
        $eventModel = new EventModel();
        $userModel = new \App\Models\UserModel();
        $event = $eventModel->find($event_id);
        $user = $userModel->find($user_id);
        return view('events/confirm_join', [
            'event' => $event,
            'user' => $user
        ]);
    }

    public function myEvents()
    {
        $userId = session()->get('user_id');
        $db = \Config\Database::connect();

        $builder = $db->table('user_events');
        $builder->select('events.title, events.type, events.event_date, events.description');
        $builder->join('events', 'events.id = user_events.event_id');
        $builder->where('user_events.user_id', $userId);
        $query = $builder->get();

        $data['myEvents'] = $query->getResultArray();

        return view('events/my_events', $data);
    }

    public function book()
    {
        $model = new \App\Models\EventModel();
        $events = $model->where('event_date >=', date('Y-m-d'))->orderBy('event_date', 'ASC')->findAll();
        $tournaments = array_filter($events, function($e) { return strtolower($e['type']) === 'tournament'; });
        $classes = array_filter($events, function($e) { return strtolower($e['type']) === 'class'; });
        return view('book/index', [
            'tournaments' => $tournaments,
            'classes' => $classes
        ]);
    }
}
