<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->data['website'] = Website::firstOrFail();

        return view('contact-us', $this->data);
    }
}
