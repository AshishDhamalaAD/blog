<?php

namespace App\View\Components;

use App\Models\Advertisement;
use App\Models\Article;
use App\Models\Menu;
use App\Models\Tag;
use App\Models\WebsiteSocialMedia;
use Illuminate\View\Component;

class FrontendLayout extends Component
{
    public array $data = [];

    public function __construct(?Advertisement $sideAd = null)
    {
        $this->data['sideAd'] = $sideAd;
    }

    public function render()
    {
        $this->data['websiteSocialMedia'] = WebsiteSocialMedia::query()
            ->select(['id', 'social_media_id', 'url'])
            ->with('socialMedia:id,name')
            ->get();

        $this->data['recentArticles'] = Article::query()
            ->select(['id', 'title', 'slug', 'image', 'user_id'])
            ->with(['user:id,name'])
            ->visible()
            ->latest('published_at')
            ->take(5)
            ->get();

        $this->data['popularArticles'] = Article::query()
            ->select(['id', 'title', 'slug', 'image', 'user_id', 'views'])
            ->with(['user:id,name'])
            ->visible()
            ->latest('views')
            ->take(5)
            ->get();

        $this->data['tags'] = Tag::query()
            ->select(['id', 'name', 'slug'])
            ->withSum('articles', 'views')
            ->take(5)
            ->orderByDesc('articles_sum_views')
            ->get();

        $this->data['menus'] = Menu::query()
            ->select(['id', 'name', 'url', 'type'])
            ->with(['children:id,parent_id,name,url,article_id', 'children.article:id,title,slug,image'])
            ->root()
            ->get();

        // dd($this->data['recentArticles']->toArray());

        return view('layouts.frontend', $this->data);
    }
}
