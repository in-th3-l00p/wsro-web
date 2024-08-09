@extends("layouts.main")

@section("content")
    <x-admin.container :title="__('Delete user') . ' ' . $user->name">

    <form
        method="post"
        action="{{ route("admin.users.destroy", [ "user" => $user ]) }}"
    >
        @csrf
        @method("DELETE")

        <p class="mb-4">{{ __("Are you sure you want to delete user") }}: {{ $user->name }}</p>

        <div class="flex gap-4">
            <button type="submit" class="btn">
                {{ __("Yes") }}
            </button>

            <a href="{{ url()->previous() }}" class="btn">
                {{ __("No") }}
            </a>
        </div>
    </form>
    </x-admin.container>
@endsection
