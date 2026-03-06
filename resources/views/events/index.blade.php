<x-layouts.main :title="'Events'">

    {{-- Page Header --}}
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold tracking-tight text-white">🎪 Workshop Events</h1>
        <p class="mt-2 text-lg text-gray-400">Browse and register for upcoming Senior-to-Junior workshops</p>

        {{-- Registration Counter --}}
        <div class="mt-4 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm">
            <span class="text-gray-400">Your registrations:</span>
            <span class="font-bold {{ $userRegistrationCount >= 3 ? 'text-red-400' : 'text-emerald-400' }}">
                {{ $userRegistrationCount }} / 3
            </span>
        </div>
    </div>

    {{-- Events Grid --}}
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($events as $event)
            @php
                $remaining = $event->total_seats - $event->registrations_count;
                $isRegistered = in_array($event->id, $registeredEventIds);
                $isFull = $remaining <= 0;
                $maxReached = $userRegistrationCount >= 3;
            @endphp

            <div class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm transition hover:border-white/20 hover:bg-white/10">
                {{-- Color Bar --}}
                <div class="h-1.5 w-full bg-gradient-to-r {{ $isFull ? 'from-red-500 to-orange-500' : 'from-indigo-500 to-purple-500' }}"></div>

                <div class="p-6">
                    {{-- Title --}}
                    <h3 class="mb-3 text-xl font-bold text-white">{{ $event->title }}</h3>

                    {{-- Details --}}
                    <div class="mb-4 space-y-2">
                        <div class="flex items-center gap-2 text-sm text-gray-400">
                            <span>🎤</span>
                            <span>{{ $event->speaker }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-400">
                            <span>📍</span>
                            <span>{{ $event->location }}</span>
                        </div>
                    </div>

                    {{-- Seats Info --}}
                    <div class="mb-5">
                        <div class="mb-1.5 flex items-center justify-between text-sm">
                            <span class="text-gray-400">Seats</span>
                            <span class="{{ $remaining > 0 ? 'text-emerald-400' : 'text-red-400' }} font-semibold">
                                {{ $remaining }} / {{ $event->total_seats }} remaining
                            </span>
                        </div>
                        {{-- Progress Bar --}}
                        <div class="h-2 overflow-hidden rounded-full bg-white/10">
                            @php
                                $percentage = $event->total_seats > 0
                                    ? min(100, ($event->registrations_count / $event->total_seats) * 100)
                                    : 100;
                            @endphp
                            <div class="h-full rounded-full transition-all duration-500
                                {{ $percentage >= 100 ? 'bg-gradient-to-r from-red-500 to-orange-500' : ($percentage >= 70 ? 'bg-gradient-to-r from-amber-500 to-orange-400' : 'bg-gradient-to-r from-emerald-500 to-teal-400') }}"
                                 style="width: {{ $percentage }}%">
                            </div>
                        </div>
                    </div>

                    {{-- Action Button --}}
                    @if($isRegistered)
                        {{-- Already Registered → Cancel --}}
                        <div class="space-y-2">
                            <span class="block w-full rounded-xl bg-emerald-500/10 py-2.5 text-center text-sm font-medium text-emerald-400">
                                ✅ Registered
                            </span>
                            <form method="POST" action="{{ route('events.unregister', $event) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full rounded-xl border border-red-500/20 bg-red-500/5 py-2 text-sm font-medium text-red-400 transition hover:bg-red-500/10"
                                        onclick="return confirm('Cancel your registration for this event?')">
                                    Cancel Registration
                                </button>
                            </form>
                        </div>
                    @elseif($isFull)
                        {{-- No seats → Closed --}}
                        <button disabled
                                class="w-full cursor-not-allowed rounded-xl bg-red-500/10 py-2.5 text-sm font-medium text-red-400">
                            🚫 Closed — No Seats
                        </button>
                    @elseif($maxReached)
                        {{-- Max registrations reached --}}
                        <button disabled
                                class="w-full cursor-not-allowed rounded-xl bg-amber-500/10 py-2.5 text-sm font-medium text-amber-400">
                            ⚠️ Max 3 Registrations Reached
                        </button>
                    @else
                        {{-- Available → Register --}}
                        <form method="POST" action="{{ route('events.register', $event) }}">
                            @csrf
                            <button type="submit"
                                    class="w-full rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:from-indigo-600 hover:to-purple-700 hover:shadow-indigo-500/40">
                                🎫 Register Now
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-gray-500">
                <p class="text-lg">No events available at the moment.</p>
                <p class="mt-1 text-sm">Check back later for upcoming workshops!</p>
            </div>
        @endforelse
    </div>

</x-layouts.main>
