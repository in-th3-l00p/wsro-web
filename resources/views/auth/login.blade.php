@extends("layouts.main")

@section("content")
    <main class="w-screen h-screen bg-rose-900 flex justify-center items-center">
        <form
            action="{{ route("login.submit") }}"
            method="post"
            class="card flex flex-col items-center gap-12"
        >
            @csrf

            <img
                src="/static/logo.png" alt="logo"
                class="w-32"
            >

            @error("auth")
                <x-ui.danger-alert>
                    {{ $message }}
                </x-ui.danger-alert>
            @enderror

            <div class="flex flex-col gap-6">
                <div>
                    <div class="flex items-center">
                        <label for="email" class="label w-32">{{ __("Email") }}:</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="input"
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
                    <div class="flex items-center">
                        <label for="password" class="label w-32">{{ __("Password") }}:</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="input"
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

            <button type="submit" class="btn">{{ __("Login") }}</button>
        </form>
    </main>
@endsection
