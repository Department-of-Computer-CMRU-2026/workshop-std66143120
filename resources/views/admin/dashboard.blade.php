<x-layouts.main :title="'Admin Dashboard'">

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-white">📊 Admin Dashboard</h1>
        <p class="mt-1 text-gray-400">Overview of all events and registrations</p>
    </div>

    {{-- Summary Cards --}}
    <div class="mb-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        {{-- Total Events --}}
        <div class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-sm transition hover:border-indigo-500/30 hover:bg-white/10">
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-indigo-500/10 blur-2xl transition group-hover:bg-indigo-500/20"></div>
            <div class="relative">
                <p class="text-sm font-medium text-gray-400">Total Events</p>
                <p class="mt-2 text-4xl font-bold text-white">{{ $totalEvents }}</p>
            </div>
        </div>

        {{-- Total Registrations --}}
        <div class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-sm transition hover:border-emerald-500/30 hover:bg-white/10">
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-emerald-500/10 blur-2xl transition group-hover:bg-emerald-500/20"></div>
            <div class="relative">
                <p class="text-sm font-medium text-gray-400">Total Registrations</p>
                <p class="mt-2 text-4xl font-bold text-white">{{ $totalRegistrations }}</p>
            </div>
        </div>

        {{-- Total Users --}}
        <div class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-sm transition hover:border-purple-500/30 hover:bg-white/10">
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-purple-500/10 blur-2xl transition group-hover:bg-purple-500/20"></div>
            <div class="relative">
                <p class="text-sm font-medium text-gray-400">Total Users</p>
                <p class="mt-2 text-4xl font-bold text-white">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>

    {{-- Events Table --}}
    <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm">
        <div class="border-b border-white/10 px-6 py-4">
            <h2 class="text-lg font-semibold text-white">All Events Summary</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-gray-400">
                        <th class="px-6 py-3 font-medium">#</th>
                        <th class="px-6 py-3 font-medium">Title</th>
                        <th class="px-6 py-3 font-medium">Speaker</th>
                        <th class="px-6 py-3 font-medium">Location</th>
                        <th class="px-6 py-3 font-medium text-center">Total Seats</th>
                        <th class="px-6 py-3 font-medium text-center">Registered</th>
                        <th class="px-6 py-3 font-medium text-center">Remaining</th>
                        <th class="px-6 py-3 font-medium text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($events as $index => $event)
                        @php
                            $remaining = $event->total_seats - $event->registrations_count;
                        @endphp
                        <tr class="transition hover:bg-white/5">
                            <td class="px-6 py-4 text-gray-400">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-medium text-white">{{ $event->title }}</td>
                            <td class="px-6 py-4 text-gray-300">{{ $event->speaker }}</td>
                            <td class="px-6 py-4 text-gray-300">{{ $event->location }}</td>
                            <td class="px-6 py-4 text-center text-gray-300">{{ $event->total_seats }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center rounded-full bg-indigo-500/10 px-2.5 py-0.5 text-xs font-medium text-indigo-400">
                                    {{ $event->registrations_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                    {{ $remaining > 0 ? 'bg-emerald-500/10 text-emerald-400' : 'bg-red-500/10 text-red-400' }}">
                                    {{ $remaining }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.events.participants', $event) }}"
                                   class="inline-flex items-center gap-1 rounded-lg bg-white/10 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-white/20">
                                    👥 Participants
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                No events found. Create your first event!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.main>
