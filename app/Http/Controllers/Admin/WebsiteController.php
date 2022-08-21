<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Http\Requests\Admin\WebsiteRequest;
use App\Models\Article;
use App\Models\Enums\ArticleStatusEnum;
use App\Models\SocialMedia;
use App\Models\Tag;
use App\Models\Website;
use App\Models\WebsiteSocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WebsiteController extends Controller
{
    private string $resource = 'website';
    private string $routeResource = 'websites';

    public function edit(Request $request)
    {
        $website = Website::firstOrFail();

        // $this->authorize('update', $website);

        $data['title'] = __('Edit Website');
        $data['routeResource'] = $this->routeResource;
        $data['model'] = $website;
        $websiteSocialMedia = WebsiteSocialMedia::pluck('url', 'social_media_id');
        $data['socialMedia'] = SocialMedia::select(['id', 'name'])
            ->get()
            ->map(function (SocialMedia $socialMedia) use ($websiteSocialMedia) {
                $socialMedia->url = $websiteSocialMedia->get($socialMedia->id);

                return $socialMedia;
            });

        return view('admin.website.create', $data);
    }

    public function update(WebsiteRequest $request)
    {
        // $this->authorize('update', $article);
        $website = Website::firstOrFail();

        $website->update($request->updateData($website));

        $this->updateCreateOrDeleteSocialMedia($request);

        return back()->with('success', 'Article updated successfully.');
    }

    private function updateCreateOrDeleteSocialMedia(WebsiteRequest $request)
    {
        $request->collect('social_media_urls')->each(function ($url, $socialMediaId) {
            if (!$url) {
                WebsiteSocialMedia::where('social_media_id', $socialMediaId)->delete();
            } else {
                WebsiteSocialMedia::updateOrCreate(
                    ['social_media_id' => $socialMediaId],
                    ['url' => $url]
                );
            }
        });
    }
}
