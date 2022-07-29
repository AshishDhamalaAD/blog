<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Models\Enums\ArticleStatusEnum;
use App\Models\Tag;
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
            'Created By',
            'Created Date',
            'Published Date',
            'Publish Status',
            'Status',
            'Action',
        ];
        $data['items'] = Article::with(['user:id,name'])->latest()->paginate(10);
        $data['resource'] = 'article';
        $data['routeResource'] = 'articles';
        $data['title'] = 'Articles';

        return view('admin.articles.index', $data);
    }

    public function create(Request $request)
    {
        $data['title'] = __('Add new Article');
        $data['routeResource'] = 'articles';
        $data['statuses'] = ArticleStatusEnum::cases();
        $data['tags'] = Tag::select(['id as value', 'name'])->get();
        $data['model'] = new Article([
            'status' => ArticleStatusEnum::ACTIVE,
            'tag_ids' => [],
        ]);

        return view('admin.articles.create', $data);
    }

    public function store(ArticleRequest $request)
    {
        $article = Article::create($request->createData());

        $article->tags()->attach($request->tag_ids);

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }

    public function edit(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $data['title'] = __('Edit Article');
        $data['routeResource'] = 'articles';
        $data['statuses'] = ArticleStatusEnum::cases();
        $data['tags'] = Tag::select(['id as value', 'name'])->get();
        $article->tag_ids = $article->tags()->pluck('tags.id')->toArray();
        $data['model'] = $article;

        return view('admin.articles.create', $data);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);

        $article->update($request->updateData($article));

        $article->tags()->sync($request->tag_ids);

        return back()->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->deleteImage();

        $article->delete();

        return back()->with('success', 'Article deleted successfully.');
    }
}
