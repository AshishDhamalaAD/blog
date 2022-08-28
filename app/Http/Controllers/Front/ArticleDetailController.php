<?php

namespace App\Http\Controllers\Front;

use App\Models\Advertisement;
use App\Models\Article;
use App\Models\Enums\AdvertisementPositionEnum;
use App\Models\Enums\AdvertisementStatusEnum;
use Illuminate\Http\Request;

class ArticleDetailController extends CommonController
{
    public function __invoke(Request $request, Article $article)
    {
        $this->data['article'] = $article->load([
            'tags:id,name,slug',
            'user:id,name,image,description',
            'user.socialMedia',
        ]);

        $ads = Advertisement::query()
            ->select(['id', 'image', 'position'])
            ->where('status', AdvertisementStatusEnum::ACTIVE)
            ->whereIn('position', [
                AdvertisementPositionEnum::ARTICLE_TOP,
                AdvertisementPositionEnum::ARTICLE_BOTTOM,
            ])
            ->get();

        $this->data['topAd'] = $ads->firstWhere('position', AdvertisementPositionEnum::ARTICLE_TOP);
        $this->data['bottomAd'] = $ads->firstWhere('position', AdvertisementPositionEnum::ARTICLE_BOTTOM);

        return view('articles.show', $this->data);
    }
}
