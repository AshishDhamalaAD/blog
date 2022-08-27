<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

class TagArticlesController extends CommonController
{
    public function __invoke(Request $request)
    {
        return view('tags.articles', $this->data);
    }
}
