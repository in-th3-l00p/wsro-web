@extends("layouts.main")

@section("content")
    <x-user.layout
        :title="__('Hello') . ', ' . request()->user()->name . '!'"
        :breadcrumbPath="[
            [ 'name' => __('Dashboard') ],
        ]"
    >
        <p>fdsafdsagfdsafs</p>
    </x-user.layout>
@endsection
