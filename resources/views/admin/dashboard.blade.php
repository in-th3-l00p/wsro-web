@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Hello') . ', ' . request()->user()->name . '!'"
        :breadcrumbPath="[
            [ 'name' => __('Dashboard') ],
        ]"
    >
        <p>hello world</p>
    </x-admin.container>
@endsection
