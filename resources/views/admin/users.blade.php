@extends("layouts.main")

@section("content")
    <x-admin.container :title="__('Users')">
        <form class="mb-8" id="search-form">
            <h2 class="text-2xl mb-2">{{ __("Search") }}:</h2>

            <div class="form-group mb-2">
                <label for="search_name" class="label w-16">{{ __("Name") }}:</label>
                <input
                    type="text" name="search_name" id="search_name" class="input"
                    placeholder="{{ __("Search by name") }}"
                    value="{{ request()->search_name }}"
                >
            </div>

            <div class="form-group mb-4">
                <label for="search_email" class="label w-16">{{ __("Email") }}:</label>
                <input
                    type="text" name="search_email" id="search_email" class="input"
                    placeholder="{{ __("Search by email") }}"
                    value="{{ request()->search_email }}"
                >
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn">
                    {{ __("Search") }}
                </button>
            </div>
        </form>

        @if ($users->count() === 0)
            <p class="text-center text-zinc-600 text-lg">
                {{ __("No users found.") }}
            </p>
        @endif

        @if ($users->count() > 0)
            <div @class([
                "max-w-fit",
                "animate-fadein" => !request()->has("page")
            ])>
                <table class="table mb-4">
                    <thead>
                        <tr>
                            <th>{{ __("Name") }}</th>
                            <th>{{ __("Email") }}</th>
                            <th>{{ __(" Created at") }}</th>
                            <th>{{ __(" Updated at") }}</th>
                            <th>{{ __(" Role") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>{{ $user->role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        @endif
    </x-admin.container>
@endsection
