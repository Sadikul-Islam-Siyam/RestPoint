@extends('layouts.app')

@section('content')
<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 bg-slate-950">
    <div class="sm:mx-auto w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold tracking-tight text-white font-display">
            Claim your tavern badge
        </h2>
        <p class="mt-2 text-center text-sm text-slate-400">
            Or
            <a href="{{ route('login') }}" class="font-medium text-amber-500 hover:text-amber-400 transition">
                pull up a stool with an existing account
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto w-full sm:max-w-md">
        <div class="bg-slate-900 border border-slate-800/80 py-8 px-4 shadow-xl rounded-2xl sm:px-10">
            <form class="space-y-5" action="{{ route('register') }}" method="POST">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-300">
                        Display Name / Nickname
                    </label>
                    <div class="mt-1.5">
                        <input id="name" name="name" type="text" autocomplete="name" required value="{{ old('name') }}"
                               class="block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-slate-100 placeholder-slate-500 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm">
                    </div>
                    @error('name')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="username" class="block text-sm font-medium text-slate-300">
                        Unique Handle / Username (@handle)
                    </label>
                    <div class="mt-1.5">
                        <input id="username" name="username" type="text" autocomplete="username" required value="{{ old('username') }}"
                               class="block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-slate-100 placeholder-slate-500 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm">
                    </div>
                    @error('username')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300">
                        Email address
                    </label>
                    <div class="mt-1.5">
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                               class="block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-slate-100 placeholder-slate-500 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm">
                    </div>
                    @error('email')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300">
                        Password
                    </label>
                    <div class="mt-1.5">
                        <input id="password" name="password" type="password" required
                               class="block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-slate-100 placeholder-slate-500 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm">
                    </div>
                    @error('password')
                        <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-300">
                        Confirm Password
                    </label>
                    <div class="mt-1.5">
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-slate-100 placeholder-slate-500 focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 sm:text-sm">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="flex w-full justify-center rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 px-4 py-3 text-sm font-bold text-slate-950 shadow-md hover:from-amber-400 hover:to-amber-500 transition duration-200">
                        Register Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
