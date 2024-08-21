@php use App\Models\TestProjects\TestProject;use App\Models\User; @endphp
@extends("layouts.main")

@section("content")
    <x-user.layout
        :title="__('Hello') . ', ' . request()->user()->name . '!'"
        :breadcrumbPath="[
            [ 'name' => __('Dashboard') ],
        ]"
    >
        <div class="bg-white rounded-md shadow-md">
            <div class="mx-auto max-w-7xl">
                <div class="grid grid-cols-1 gap-px bg-white sm:grid-cols-2 lg:grid-cols-4">
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        <p class="text-sm font-medium leading-6 text-gray-500">Number of test projects</p>
                        <p class="mt-2 flex items-baseline gap-x-2">
                            <span
                                class="text-4xl font-semibold tracking-tight"
                            >
                                {{ TestProject::query()->where("visibility", '=', "public")->count() }}
                            </span>
                            <span class="text-sm text-gray-500">test projects</span>
                        </p>
                    </div>
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        <p class="text-sm font-medium leading-6 text-gray-500">Number of users</p>
                        <p class="mt-2 flex items-baseline gap-x-2">
                            <span class="text-4xl font-semibold tracking-tight">
                                {{ User::query()->count() }}
                            </span>
                            <span class="text-sm text-gray-500">users</span>
                        </p>
                    </div>
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        <p class="text-sm font-medium leading-6 text-gray-500">Number of admins</p>
                        <p class="mt-2 flex items-baseline gap-x-2">
                            @php $admins =  User::query()->where("role", '=', 'admin')->count(); @endphp
                            <span class="text-4xl font-semibold tracking-tight">
                                {{ $admins }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $admins > 1 ? 'admins' : 'admin' }}
                            </span>
                        </p>
                    </div>
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        <p class="text-sm font-medium leading-6 text-gray-500">Number of competitors</p>
                        <p class="mt-2 flex items-baseline gap-x-2">
                            @php $users =  User::query()->where("role", '=', 'user')->count(); @endphp
                            <span class="text-4xl font-semibold tracking-tight">
                                {{ $users }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $users > 1 ? 'competitors' : 'competitor' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-user.layout>
@endsection
