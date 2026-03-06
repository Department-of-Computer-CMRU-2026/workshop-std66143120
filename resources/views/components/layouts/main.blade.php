<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Event Registration System' }} - {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-gray-100">

    {{-- Navigation Bar --}}
    <nav class="sticky top-0 z-50 border-b border-white/10 bg-gray-900/80 backdrop-blur-xl">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                {{-- Logo / Brand --}}
                <div class="flex items-center gap-8">
                    <a href="{{ route('events.index') }}" class="flex items-center gap-2">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 font-bold text-white shadow-lg shadow-indigo-500/25">
                            E
                        </div>
                        <span class="text-lg font-semibold tracking-tight text-white">EventReg</span>
                    </a>

                    {{-- Nav Links --}}
                    <div class="hidden items-center gap-1 md:flex">
                        <a href="{{ route('events.index') }}"
                           class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('events.*') ? 'bg-white/10 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                            🎪 Events
                        </a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                📊 Admin Dashboard
                            </a>
                            <a href="{{ route('admin.events.index') }}"
                               class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.events.*') ? 'bg-white/10 text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                                ⚙️ Manage Events
                            </a>
                        @endif
                    </div>
                </div>

                {{-- User Info & Logout --}}
                <div class="flex items-center gap-4">
                    <div class="hidden items-center gap-2 md:flex">
                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 text-xs font-bold text-white">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="text-sm">
                            <p class="font-medium text-white">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400">{{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-lg border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-medium text-gray-300 transition hover:bg-white/10 hover:text-white">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif
        @if(session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif
    </div>

    {{-- Main Content --}}
    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="border-t border-white/5 py-6 text-center text-sm text-gray-500">
        <p>Event Registration System &copy; {{ date('Y') }} — Senior-to-Junior Workshop</p>
    </footer>

</body>
</html>
