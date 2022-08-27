<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use App\Models\Enums\ArticleStatusEnum;
use Illuminate\Http\Request;

class HomeController extends CommonController
{
    public function __invoke(Request $request)
    {
        $this->data['articles'] = Article::query()
            ->with(['user:id,name'])
            ->visible()
            ->simplePaginate(7);

        // dd($this->data['articles']);

        return view('home', $this->data);
    }
}
