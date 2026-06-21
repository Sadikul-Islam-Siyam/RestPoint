@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 bg-slate-950">
    <div class="sm:mx-auto w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold tracking-tight text-white font-display">
            Pull up a stool to the tavern
        </h2>
        <p class="mt-2 text-center text-sm text-slate-400">
            Or
            <a href="{{ route('register') }}" class="font-medium text-amber-500 hover:text-amber-400 transition">
                register a new guild license
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto w-full sm:max-w-md">
        <div class="bg-slate-900 border border-slate-800/80 py-8 px-4 shadow-xl rounded-2xl sm:px-10">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf

                <div>
                    <label for="login" class="block text-sm font-medium text-slate-300">
                        Username or Email address
                    </label>
                    <div class="mt-1.5">
                        <input id="login" name="login" type="text" autocomplete="username" required value="{{ old('login') }}"
                               class="block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-slate-100 placeholder-slate-500 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm">
                    </div>
                    @error('login')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300">
                        Password
                    </label>
                    <div class="mt-1.5">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-slate-100 placeholder-slate-500 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm">
                    </div>
                    @error('password')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                               class="h-4 w-4 rounded border-slate-800 bg-slate-950 text-amber-500 focus:ring-amber-500">
                        <label for="remember" class="ml-2 block text-sm text-slate-400 select-none">
                            Remember my credentials
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="flex w-full justify-center rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 px-4 py-3 text-sm font-bold text-slate-950 shadow-md hover:from-amber-400 hover:to-amber-500 transition duration-200">
                        Enter Tavern
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
