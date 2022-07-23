<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Models\Enums\ArticleStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        $data['headers'] = [
            'Image',
            'Title',
            'Views',
            'Status',
            'Created By',
            'Created Date',
            'Published Date',
            'Is Published?',
            'Action',
        ];
        $data['items'] = Article::with(['user:id,name'])->latest()->paginate(10);
        $data['resource'] = 'article';
        $data['resources'] = 'articles';
        $data['title'] = 'Articles';

        return view('admin.articles.index', $data);
    }

    public function create(Request $request)
    {
        $data['statuses'] = ArticleStatusEnum::cases();
        $data['article'] = new Article([
            'status' => ArticleStatusEnum::ACTIVE,
        ]);

        return view('admin.articles.create', $data);
    }

    public function store(ArticleRequest $request)
    {
        $article = Article::create($request->createData());

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }

    public function edit(Request $request, Article $article)
    {
        $data['statuses'] = ArticleStatusEnum::cases();
        $data['article'] = $article;

        return view('admin.articles.create', $data);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->updateData($article));

        return back()->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $article->deleteImage();

        $article->delete();

        return back()->with('success', 'Article deleted successfully.');
    }
}
