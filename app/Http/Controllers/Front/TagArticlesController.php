<?php

namespace App\Http\Controllers\Front;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagArticlesController extends CommonController
{
    public function __invoke(Request $request, Tag $tag)
    {
        $this->data['tag'] = $tag;

        $this->data['articles'] = $tag->articles()
            ->with(['user:id,name'])
            ->latest('published_at')
            ->visible()
            ->simplePaginate(7);

        return view('tags.articles', $this->data);
    }
}
