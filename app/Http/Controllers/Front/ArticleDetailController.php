<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

class ArticleDetailController extends CommonController
{
    public function __invoke(Request $request)
    {
        return view('articles.show', $this->data);
    }
}
