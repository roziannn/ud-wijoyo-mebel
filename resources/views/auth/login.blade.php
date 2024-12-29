{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.master')
@section('contents')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12 mx-auto">
                    <div class="login-register-cover">
                        <div class="text-center">
                            <h2 class="mb-3 text-brand-1">Login</h2>
                            <p class="font-sm text-muted mb-30">Login to your account.</p>
                        </div>
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <form class="login-register text-start mt-20" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            id="email" type="text" required="" name="email" placeholder=""
                                            value="{{ old('email') }}" style="padding:10px;" autofocus>

                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                    </div>
                                </div>
                                <div class="col-xl-12 mt-3">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="input-4">Password</label>
                                            <a href="{{ route('password.request') }}"
                                                class="d-flex justify-content-end">forgot password?</a>
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group">
                                                <input
                                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                    id="password" type="password" required="" name="password"
                                                    placeholder="************" style="padding:10px;">
                                                {{-- <span class="input-group-append">
                                                    <button class=" btn-eye see-password" type="button">
                                                        <i class="ti-eye"></i>
                                                    </button>
                                                </span> --}}
                                            </div>
                                        </div>

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                </div>
                            </div>
                            <div class="py-4">
                                <div class="form-group">
                                    <button class="btn btn-default hover-up w-100" type="submit"
                                        name="login">Login</button>
                                </div>
                                <div class="text-muted text-center mt-5">Don't have an account?
                                    <a href="{{ route('register') }}" class="font-weight-bold">Register Here</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
