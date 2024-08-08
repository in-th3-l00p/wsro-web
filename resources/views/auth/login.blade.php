@extends("layouts.main")

@section("content")
    <main class="w-screen h-screen bg-rose-900 flex justify-center items-center">
        <form
            action="{{ route("login.submit") }}"
            method="post"
            class="card animate-fadein flex flex-col items-center gap-12"
        >
            @csrf

            <img
                src="/static/logo.png" alt="logo"
                class="w-32"
            >

            <div class="flex flex-col gap-6">
                @error("auth")
                    <x-ui.danger-alert>
                        {{ $message }}
                    </x-ui.danger-alert>
                @enderror

                <div>
                    <div class="form-group">
                        <label for="email" class="dark-label w-32">{{ __("Email") }}:</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="dark-input"
                            placeholder="{{ __("Email address") }}"
                        >
                    </div>
                    @error("email")
                        <x-ui.danger-alert>
                            {{ $message }}
                        </x-ui.danger-alert>
                    @enderror
                </div>

                <div>
                    <div class="form-group">
                        <label for="password" class="dark-label w-32">{{ __("Password") }}:</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="dark-input"
                            placeholder="{{ __("Password") }}"
                        >
                    </div>
                    @error("password")
                        <x-ui.danger-alert>
                            {{ $message }}
                        </x-ui.danger-alert>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-lg btn-shadow-dark">{{ __("Login") }}</button>
        </form>
    </main>
@endsection
