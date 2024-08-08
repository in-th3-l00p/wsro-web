@extends("layouts.main")

@section("content")
    <x-admin.container title="Users">
        @if ($users->count() === 0)
            <p class="text-center text-zinc-600 text-lg">
                {{ __("No users found.") }}
            </p>
        @endif

        @if ($users->count() > 0)
            <table class="table mb-4">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Role</th>
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
        @endif
    </x-admin.container>
@endsection
