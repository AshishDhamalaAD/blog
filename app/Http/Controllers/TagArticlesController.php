<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagArticlesController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('tags.articles');
    }
}
