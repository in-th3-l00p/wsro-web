@extends("layouts.main")

@section("content")
    <x-admin.container :title="'Hello, ' . request()->user()->name . '!'">
        <p>hello world</p>
    </x-admin.container>
@endsection
