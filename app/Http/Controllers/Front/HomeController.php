<?php

namespace App\Http\Controllers\Front;

use App\Models\Advertisement;
use App\Models\Article;
use App\Models\Enums\AdvertisementPositionEnum;
use App\Models\Enums\AdvertisementStatusEnum;
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

        $ads = Advertisement::query()
            ->select(['id', 'image', 'position'])
            ->where('status', AdvertisementStatusEnum::ACTIVE)
            ->whereIn('position', [
                AdvertisementPositionEnum::HOME_TOP,
                AdvertisementPositionEnum::HOME_SIDE,
            ])
            ->get();

        $this->data['topAd'] = $ads->firstWhere('position', AdvertisementPositionEnum::HOME_TOP);
        $this->data['sideAd'] = $ads->firstWhere('position', AdvertisementPositionEnum::HOME_SIDE);

        // dd($this->data['articles']);

        return view('home', $this->data);
    }
}
