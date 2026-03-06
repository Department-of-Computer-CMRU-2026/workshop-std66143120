<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Regular User
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create Sample Events
        $events = [
            [
                'title' => 'Introduction to Laravel 12',
                'speaker' => 'Dr. Somchai Phasuk',
                'location' => 'Room A301, CS Building',
                'total_seats' => 30,
            ],
            [
                'title' => 'Building REST APIs with Laravel',
                'speaker' => 'Prof. Apinya Chaiwong',
                'location' => 'Room B205, Engineering Building',
                'total_seats' => 25,
            ],
            [
                'title' => 'Frontend Mastery with Tailwind CSS',
                'speaker' => 'Aj. Nattapong Srisuk',
                'location' => 'Computer Lab 1, Floor 3',
                'total_seats' => 20,
            ],
            [
                'title' => 'Database Design with PostgreSQL',
                'speaker' => 'Dr. Wichai Mongkol',
                'location' => 'Room C102, Science Building',
                'total_seats' => 15,
            ],
            [
                'title' => 'Git & DevOps Workshop',
                'speaker' => 'Aj. Pattaraporn Saelee',
                'location' => 'Smart Classroom, Floor 4',
                'total_seats' => 2,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
