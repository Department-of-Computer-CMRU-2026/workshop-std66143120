<x-layouts.main :title="'Edit Event'">

    {{-- Page Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.events.index') }}" class="mb-4 inline-flex items-center gap-1 text-sm text-gray-400 transition hover:text-white">
            ← Back to Events
        </a>
        <h1 class="text-3xl font-bold tracking-tight text-white">✏️ Edit Event</h1>
        <p class="mt-1 text-gray-400">Update the details for "{{ $event->title }}"</p>
    </div>

    {{-- Form Card --}}
    <div class="mx-auto max-w-2xl overflow-hidden rounded-2xl border border-white/10 bg-white/5 p-8 backdrop-blur-sm">
        <form method="POST" action="{{ route('admin.events.update', $event) }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label for="title" class="mb-2 block text-sm font-medium text-gray-300">Event Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required
                       class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-gray-500 transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                @error('title')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Speaker --}}
            <div>
                <label for="speaker" class="mb-2 block text-sm font-medium text-gray-300">Speaker</label>
                <input type="text" name="speaker" id="speaker" value="{{ old('speaker', $event->speaker) }}" required
                       class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-gray-500 transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                @error('speaker')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Location --}}
            <div>
                <label for="location" class="mb-2 block text-sm font-medium text-gray-300">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}" required
                       class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-gray-500 transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                @error('location')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Total Seats --}}
            <div>
                <label for="total_seats" class="mb-2 block text-sm font-medium text-gray-300">Total Seats</label>
                <input type="number" name="total_seats" id="total_seats" value="{{ old('total_seats', $event->total_seats) }}" required min="1"
                       class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder-gray-500 transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                @error('total_seats')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:from-indigo-600 hover:to-purple-700 hover:shadow-indigo-500/40">
                    💾 Update Event
                </button>
                <a href="{{ route('admin.events.index') }}" class="text-sm text-gray-400 transition hover:text-white">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</x-layouts.main>
