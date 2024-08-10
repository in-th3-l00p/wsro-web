@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Edit user') . ' ' . $user->name"
        :breadcrumbPath="[
            [ 'href' => route('admin.users.index'), 'name' => __('Users') ],
            [ 'name' => __('Edit user') . ' ' . $user->name ],
        ]"
    >
        <x-slot:subtitle>
            <x-admin.container-subtitle>
                {{ __("Update user's information") }}
            </x-admin.container-subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route("admin.users.update", [ "user" => $user ]) }}"
            method="post"
            class="max-w-xl animate-fadein"
        >
            @csrf
            @method("PUT")

            @if ($errors->count() > 0)
                <x-ui.danger-alert class="!bg-zinc-50 text-red-600 mb-8">
                    <p>{{ __("The following errors occurred when trying to create this user:") }}</p>
                    <ul class="list-disc ms-8">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-ui.danger-alert>
            @endif

            <div class="form-group mb-4">
                <label for="name" class="label w-32">{{ __("Name") }}:</label>
                <input
                    type="text" name="name" id="name"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("User's name") }}"
                    value="{{ $user->name }}"
                >
            </div>

            <div class="form-group mb-4">
                <label for="email" class="label w-32">{{ __("Email") }}:</label>
                <input
                    type="email" name="email" id="email"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("email")])
                    placeholder="{{ __("User's email") }}"
                    value="{{ $user->email }}"
                >
            </div>

            <div class="form-group mb-8">
                <label for="role" class="label w-32">{{ __("Role") }}:</label>
                <select
                    name="role" id="role"
                    class="select"
                >
                    <option
                        value="user"
                        @selected("user" === $user->role)
                    >{{ __("User") }}</option>
                    <option
                        value="admin"
                        @selected("admin" === $user->role)
                    >{{ __("Admin") }}</option>
                </select>
            </div>

            <button
                type="submit"
                class="btn"
                title="{{ __("Edit") }}"
            >
                {{ __("Edit") }}
            </button>
        </form>
    </x-admin.container>
@endsection
