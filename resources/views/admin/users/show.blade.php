@extends("layouts.main")

@section("content")
    <x-admin.container :title="__('User') . ' ' . $user->name">
        <div class="mb-4">
            <p>{{ __("Name") }}: {{ $user->name }}</p>
            <p>{{ __(" Email") }}: {{ $user->email }}</p>
            <p>{{ __(" Created at") }}: {{ $user->created_at }}</p>
            <p>{{ __(" Updated at") }}: {{ $user->updated_at }}</p>
        </div>

        <div class="flex items-center gap-2">
            <a
                title="{{ __("Edit user") }}"
                href="{{ route("admin.users.edit", [ "user" => $user ]) }}"
                class="icon-btn"
            >
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a
                title="{{ __("Delete user") }}"
                href="{{ route("admin.users.destroy", [ "user" => $user ]) }}"
                class="icon-btn"
            >
                <i class="fa-solid fa-trash"></i>
            </a>
        </div>
    </x-admin.container>
@endsection
