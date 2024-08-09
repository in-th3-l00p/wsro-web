@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Delete user') . ' ' . $user->name"
        :breadcrumbPath="[
            [ 'href' => route('admin.users.index'), 'name' => __('Users') ],
            [ 'name' => __('Delete user') . ' ' . $user->name ],
        ]"
    >
        <x-slot:subtitle>
            <h2 class="mt-2">{{ __("Are you sure you want to delete user") }}: {{ $user->name }} ?</h2>
        </x-slot:subtitle>

        <form
            method="post"
            action="{{ route("admin.users.destroy", [ "user" => $user ]) }}"
        >
            @csrf
            @method("DELETE")

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
