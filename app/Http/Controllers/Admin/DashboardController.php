<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with summary statistics.
     */
    public function index()
    {
        $totalEvents = Event::count();
        $totalRegistrations = Registration::count();
        $totalUsers = User::where('role', 'user')->count();

        $events = Event::withCount('registrations')->latest()->get();

        return view('admin.dashboard', compact(
            'totalEvents',
            'totalRegistrations',
            'totalUsers',
            'events'
        ));
    }
}
