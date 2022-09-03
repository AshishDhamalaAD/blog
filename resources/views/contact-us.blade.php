<x-frontend-layout>
    <h1 class="text-2xl">
        Contact Us
    </h1>

    <div class="mt-8">
        <div>Phone: <a href="tel:{{ $website->phone }}" class="hover:underline">{{ $website->phone }}</a></div>
        <div>Email: <a href="mailto:{{ $website->email }}" class="hover:underline">{{ $website->email }}</a></div>
        <div>Address: {{ $website->address }}</div>
    </div>
</x-frontend-layout>