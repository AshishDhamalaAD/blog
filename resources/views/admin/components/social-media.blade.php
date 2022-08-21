<div>
    <div class="border-b border-blue-700">
        <span class="inline-block bg-blue-500 text-white px-4 py-2">Social Media</span>
    </div>
    
    <div class="space-y-6 mt-4">
        @foreach ($items as $item)
        <x-admin::input-group
            :id="'social-media-'.$item->id"
            :name="'social_media_urls['.$item->id.']'"
            type="url"
            :label="$item->name"
            :value="$item->url"
        />
        @endforeach
    </div>
</div>