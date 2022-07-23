<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-admin::container>
        <x-admin::card>
            You're logged in!
        </x-admin::card>
    </x-admin::container>
</x-app-layout>