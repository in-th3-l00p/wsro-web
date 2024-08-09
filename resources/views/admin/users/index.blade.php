@extends("layouts.main")

@section("content")
    <x-admin.container :title="__('Users')">
        <div @class([
                "max-w-fit",
                "animate-fadein" => !request()->has("page")
            ])>
            <form class="mb-8" id="search-form">
                <div class="flex flex-wrap gap-16">
                    <div>
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

                        <button
                            type="submit"
                            class="btn mt-auto"
                            title="{{ __("Apply filters") }}"
                        >
                            {{ __("Apply") }}
                        </button>
                    </div>

                    <div>
                        <h2 class="text-2xl mb-2">{{ __("Select") }}:</h2>

                        <label for="roles">Roles:</label>
                        <div class="flex gap-6">
                            <div class="form-group">
                                <input
                                    type="checkbox"
                                    name="roles[]"
                                    id="users"
                                    value="user"
                                    class="checkbox"
                                    @checked(
                                        request()->roles === null ||
                                        in_array("user", request()->roles)
                                    )
                                >
                                <label for="users">Users</label>
                            </div>

                            <div class="form-group">
                                <input
                                    type="checkbox"
                                    name="roles[]"
                                    id="admins"
                                    value="admin"
                                    class="checkbox"
                                    @checked(
                                        request()->roles === null ||
                                        in_array("admin", request()->roles)
                                    )
                                >
                                <label for="admins">Admins</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form class="mb-16">
                <h2 class="text-2xl mb-2">{{ __("Reset filters") }}:</h2>
                <button
                    title="{{ __("Reset filters") }}"
                    type="submit"
                    class="btn"
                >
                    {{ __("Reset") }}
                </button>
            </form>

            <div class="w-full mb-4 flex items-center gap-4 flex-wrap">
                <h2 class="text-2xl">{{ __("Create user") }}:</h2>
                <a
                    title="{{ __("Create user") }}"
                    href="{{ route("admin.users.create") }}"
                    class="icon-btn"
                >
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
            @if ($users->count() > 0)
                <table class="table mb-4">
                    <thead>
                    <tr>
                        <th>{{ __("Name") }}</th>
                        <th>{{ __("Email") }}</th>
                        <th>{{ __("Created at") }}</th>
                        <th>{{ __("Updated at") }}</th>
                        <th>{{ __("Role") }}</th>
                        <th>{{ __("Operations") }}</th>
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
                            <td class="flex gap-2 items-center justify-center">
                                <a
                                    title="{{ __("Show user") }}"
                                    href="{{ route("admin.users.show", [ "user" => $user ]) }}"
                                    class="icon-btn"
                                >
                                    <i class="fa-solid fa-user"></i>
                                </a>
                                <a
                                    title="{{ __("Edit user") }}"
                                    href="{{ route("admin.users.edit", [ "user" => $user ]) }}"
                                    class="icon-btn"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <x-admin.user.delete-button :user="$user" />
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            @endif
        </div>

        @if ($users->count() === 0)
            <p class="text-center text-zinc-600 text-lg">
                {{ __("No users found.") }}
            </p>
        @endif
    </x-admin.container>
@endsection
