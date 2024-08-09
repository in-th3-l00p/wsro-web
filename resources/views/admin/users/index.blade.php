@extends("layouts.main")

@section("content")
    <x-admin.container :title="__('Users')">
        <x-slot:subtitle>
            <h2 class="mt-2">{{ __("All the users within the application") }}</h2>
        </x-slot:subtitle>

        <div @class([
                "max-w-fit",
                "animate-fadein" => !request()->has("page")
            ])>
            <x-admin.users.filter />

            <div class="w-full mb-4 flex items-center gap-2 flex-wrap">
                <h2 class="text-lg me-2">Operations:</h2>

                <a
                    title="{{ __("Create user") }}"
                    href="{{ route("admin.users.create") }}"
                    class="icon-btn"
                >
                    <i class="fa-solid fa-plus"></i>
                </a>

                <a
                    title="{{ __("Users trash") }}"
                    href="{{ route("admin.users.trash") }}"
                    class="icon-btn"
                >
                    <i class="fa-solid fa-trash-can"></i>
                </a>

                <form>
                    <button
                        type="submit"
                        title="{{ __("Reset filters") }}"
                        class="icon-btn"
                    >
                        <i class="fa-solid fa-rotate"></i>
                    </button>
                </form>
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

                                <x-admin.users.delete-button :user="$user" />
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
