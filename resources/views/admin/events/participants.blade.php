<x-layouts.main :title="'Participants - ' . $event->title">

    {{-- Page Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.events.index') }}" class="mb-4 inline-flex items-center gap-1 text-sm text-gray-400 transition hover:text-white">
            ← Back to Events
        </a>
        <h1 class="text-3xl font-bold tracking-tight text-white">👥 Participants</h1>
        <p class="mt-1 text-gray-400">Registered users for "{{ $event->title }}"</p>

        {{-- Event Info --}}
        <div class="mt-4 flex flex-wrap gap-4">
            <span class="inline-flex items-center gap-1.5 rounded-lg bg-white/10 px-3 py-1.5 text-xs font-medium text-gray-300">
                🎤 {{ $event->speaker }}
            </span>
            <span class="inline-flex items-center gap-1.5 rounded-lg bg-white/10 px-3 py-1.5 text-xs font-medium text-gray-300">
                📍 {{ $event->location }}
            </span>
            <span class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-500/10 px-3 py-1.5 text-xs font-medium text-indigo-400">
                👥 {{ $event->registrations->count() }} / {{ $event->total_seats }} seats
            </span>
        </div>
    </div>

    {{-- Participants Table --}}
    <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-gray-400">
                        <th class="px-6 py-3 font-medium">#</th>
                        <th class="px-6 py-3 font-medium">Name</th>
                        <th class="px-6 py-3 font-medium">Email</th>
                        <th class="px-6 py-3 font-medium">Registered At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($event->registrations as $index => $registration)
                        <tr class="transition hover:bg-white/5">
                            <td class="px-6 py-4 text-gray-400">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 text-xs font-bold text-white">
                                        {{ strtoupper(substr($registration->user->name, 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-white">{{ $registration->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-300">{{ $registration->user->email }}</td>
                            <td class="px-6 py-4 text-gray-400">{{ $registration->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                No participants registered yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.main>
