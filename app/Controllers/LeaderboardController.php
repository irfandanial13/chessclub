<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserEventModel;
use App\Models\EventModel;

class LeaderboardController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $membershipLevel = $this->request->getGet('membership_level');
        $month = $this->request->getGet('month');
        $search = $this->request->getGet('search');

        $query = $userModel->where('status', 'Active');
        if ($membershipLevel && $membershipLevel !== 'All') {
            $query = $query->where('membership_level', $membershipLevel);
        }
        if ($search) {
            $query = $query->like('name', $search);
        }
        $allUsers = $query->orderBy('points', 'DESC')->findAll();

        // If month filter is set, filter users who participated in events in that month
        $userEventModel = new UserEventModel();
        $eventModel = new EventModel();
        if ($month && $month !== 'All') {
            $filteredUsers = [];
            foreach ($allUsers as $user) {
                $userEvents = $userEventModel->where('user_id', $user['id'])->findAll();
                $hasEventInMonth = false;
                foreach ($userEvents as $ue) {
                    $event = $eventModel->find($ue['event_id']);
                    if ($event && date('Y-m', strtotime($event['event_date'])) === $month) {
                        $hasEventInMonth = true;
                        break;
                    }
                }
                if ($hasEventInMonth) {
                    $filteredUsers[] = $user;
                }
            }
            $allUsers = $filteredUsers;
        }

        // For each user, get their event titles
        foreach ($allUsers as &$user) {
            $userEvents = $userEventModel->where('user_id', $user['id'])->findAll();
            $eventTitles = [];
            foreach ($userEvents as $ue) {
                $event = $eventModel->find($ue['event_id']);
                if ($event) {
                    $eventTitles[] = $event['title'];
                }
            }
            $user['event_titles'] = $eventTitles;
        }
        unset($user);

        $currentUser = session()->get('user_id');

        // Get all months with events for filter dropdown
        $allEvents = $eventModel->findAll();
        $months = array_unique(array_map(function($e) {
            return date('Y-m', strtotime($e['event_date']));
        }, $allEvents));
        sort($months);

        return view('leaderboard/index', [
            'users' => $allUsers,
            'currentUser' => $currentUser,
            'months' => $months,
        ]);
    }

    // AJAX endpoint to get events for a user
    public function getUserEvents($userId)
    {
        $userEventModel = new UserEventModel();
        $eventModel = new EventModel();
        $userEvents = $userEventModel->where('user_id', $userId)->findAll();
        $events = [];
        foreach ($userEvents as $ue) {
            $event = $eventModel->find($ue['event_id']);
            if ($event) {
                $events[] = $event;
            }
        }
        return $this->response->setJSON($events);
    }
}
