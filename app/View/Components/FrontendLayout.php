<?php

namespace App\View\Components;

use App\Models\Advertisement;
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

        // dd($this->data['websiteSocialMedia']->first());

        return view('layouts.frontend', $this->data);
    }
}
