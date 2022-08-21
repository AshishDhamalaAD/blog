<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Http\Requests\Admin\WebsiteRequest;
use App\Models\Article;
use App\Models\Enums\ArticleStatusEnum;
use App\Models\Tag;
use App\Models\Website;
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

        return view('admin.website.create', $data);
    }

    public function update(WebsiteRequest $request)
    {
        // $this->authorize('update', $article);
        $website = Website::firstOrFail();

        $website->update($request->updateData($website));

        return back()->with('success', 'Article updated successfully.');
    }
}
