@php use App\Models\TestProjects\TestProject;use App\Models\User; @endphp
@extends("layouts.main")

@section("content")
    <x-user.layout
        :title="__('Hello') . ', ' . request()->user()->name . '!'"
        :breadcrumbPath="[
            [ 'name' => __('Dashboard') ],
        ]"
    >
        <div class="bg-white rounded-md shadow-md mb-16">
            <div class="mx-auto max-w-7xl">
                <div class="grid grid-cols-1 gap-px bg-white sm:grid-cols-2 lg:grid-cols-4">
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        <p class="text-sm font-medium leading-6 text-gray-500">{{ __("Number of test projects") }}</p>
                        <p class="mt-2 flex items-baseline gap-x-2">
                            <span
                                class="text-4xl font-semibold tracking-tight"
                            >
                                {{ TestProject::query()->where("visibility", '=', "public")->count() }}
                            </span>
                            <span class="text-sm text-gray-500">{{ __("test projects") }}</span>
                        </p>
                    </div>
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        <p class="text-sm font-medium leading-6 text-gray-500">{{ __("Number of users") }}</p>
                        <p class="mt-2 flex items-baseline gap-x-2">
                            <span class="text-4xl font-semibold tracking-tight">
                                {{ User::query()->count() }}
                            </span>
                            <span class="text-sm text-gray-500">{{ __("users") }}</span>
                        </p>
                    </div>
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        <p class="text-sm font-medium leading-6 text-gray-500">{{ __("Number of admins") }}</p>
                        <p class="mt-2 flex items-baseline gap-x-2">
                            @php $admins =  User::query()->where("role", '=', 'admin')->count(); @endphp
                            <span class="text-4xl font-semibold tracking-tight">
                                {{ $admins }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $admins > 1 ? __('admins') : __('admin') }}
                            </span>
                        </p>
                    </div>
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        <p class="text-sm font-medium leading-6 text-gray-500">{{ __("Number of competitors") }}</p>
                        <p class="mt-2 flex items-baseline gap-x-2">
                            @php $users =  User::query()->where("role", '=', 'user')->count(); @endphp
                            <span class="text-4xl font-semibold tracking-tight">
                                {{ $users }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $users > 1 ? __('competitors') : __('competitor') }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="section-title">{{ __("Quick access") }}</h2>
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
            <div class="relative flex items-center space-x-6 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                <div class="flex-shrink-0">
                    <i class="fa-solid fa-chart-line text-rose-600 text-6xl"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <a href="{{ route("user.test-projects.index") }}" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="text-lg font-medium text-gray-900">{{ __("Test projects") }}</p>
                        <p class="truncate text-sm text-gray-500">{{ __("Access all test projects") }}</p>
                    </a>
                </div>
            </div><div class="relative flex items-center space-x-6 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                <div class="flex-shrink-0">
                    <i class="fa-solid fa-user text-rose-600 text-6xl"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <a href="{{ route("account.index") }}" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="text-lg font-medium text-gray-900">{{ __("Profile") }}</p>
                        <p class="truncate text-sm text-gray-500">{{ __("Access your profile") }}</p>
                    </a>
                </div>
            </div>
        </div>
    </x-user.layout>
@endsection
