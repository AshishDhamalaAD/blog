@props(['message' => null])

@if($message)
<div class="bg-red-600 text-white rounded border border-red-700 px-4 py-2 fixed right-4 top-4 z-50">
    {{ $message }}
</div>
@endif