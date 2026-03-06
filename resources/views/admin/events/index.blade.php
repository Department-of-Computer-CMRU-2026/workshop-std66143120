<x-layouts.main :title="'Manage Events'">

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-white">⚙️ Manage Events</h1>
            <p class="mt-1 text-gray-400">Create, edit, and manage workshop events</p>
        </div>
        <a href="{{ route('admin.events.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:from-indigo-600 hover:to-purple-700 hover:shadow-indigo-500/40">
            ➕ Create Event
        </a>
    </div>

    {{-- Events Table --}}
    <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-gray-400">
                        <th class="px-6 py-3 font-medium">#</th>
                        <th class="px-6 py-3 font-medium">Title</th>
                        <th class="px-6 py-3 font-medium">Speaker</th>
                        <th class="px-6 py-3 font-medium">Location</th>
                        <th class="px-6 py-3 font-medium text-center">Seats</th>
                        <th class="px-6 py-3 font-medium text-center">Registered</th>
                        <th class="px-6 py-3 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($events as $index => $event)
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
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.events.participants', $event) }}"
                                       class="rounded-lg bg-white/10 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-white/20"
                                       title="View Participants">
                                        👥
                                    </a>
                                    <a href="{{ route('admin.events.edit', $event) }}"
                                       class="rounded-lg bg-amber-500/10 px-3 py-1.5 text-xs font-medium text-amber-400 transition hover:bg-amber-500/20"
                                       title="Edit Event">
                                        ✏️
                                    </a>
                                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this event?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="rounded-lg bg-red-500/10 px-3 py-1.5 text-xs font-medium text-red-400 transition hover:bg-red-500/20"
                                                title="Delete Event">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                No events yet. Click "Create Event" to get started.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.main>
