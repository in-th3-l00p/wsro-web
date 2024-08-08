@extends("layouts.main")

@section("content")
    <x-admin.container :title="__('Users')">
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
