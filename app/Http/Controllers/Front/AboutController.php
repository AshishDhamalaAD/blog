<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;

class AboutController extends CommonController
{
    public function __invoke(Request $request)
    {
        $this->data['website'] = Website::firstOrFail();

        return view('about-us', $this->data);
    }
}
