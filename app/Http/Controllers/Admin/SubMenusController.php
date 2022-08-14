<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubMenuRequest;
use App\Models\Article;
use App\Models\Menu;
use Illuminate\Http\Request;

class SubMenusController extends Controller
{
    private string $resource = 'sub-menu';
    private string $routeResource = 'sub-menus';

    public function index(Request $request)
    {
        $parentMenu = Menu::findOrFail($request->parent_id);

        $data['headers'] = [
            'Name',
            'Url',
            'Created Date',
            'Action',
        ];
        $data['items'] = Menu::with(['article:id,title,slug'])
            ->where('parent_id', $request->parent_id)
            ->paginate(10);
        $data['resource'] = $this->resource;
        $data['routeResource'] = $this->routeResource;
        $data['title'] = $parentMenu->name . "'s " . __('Sub-Menus');
        $data['parentMenu'] = $parentMenu;

        return view('admin.menus.children.index', $data);
    }

    public function create(Request $request)
    {
        $parentMenu = Menu::find($request->parent_id);
        $data['title'] = __('Add new Sub-Menu on ') . $parentMenu->name;
        $data['routeResource'] = $this->routeResource;
        $data['articles'] = Article::latest('id')
            ->get(['id', 'title', 'slug'])
            ->map(function ($article) {
                $article->url = route('articles.show', $article->slug);

                return $article;
            });
        $data['model'] = new Menu();
        $data['parentMenu'] = $parentMenu;

        return view('admin.menus.children.create', $data);
    }

    public function store(SubMenuRequest $request)
    {
        // dd($request->safe()->toArray());
        $menu = Menu::create($request->safe()->toArray());

        return redirect()->route('admin.sub-menus.index', ['parent_id' => $request->parent_id])->with('success', 'Menu created successfully.');
    }

    public function edit(Request $request, Menu $subMenu)
    {
        $this->authorize('update', $subMenu);

        $parentMenu = Menu::find($request->parent_id);
        $data['title'] = __('Edit Sub-Menu of ') . $parentMenu->name;
        $data['routeResource'] = $this->routeResource;
        $data['articles'] = Article::latest('id')
            ->get(['id', 'title', 'slug'])
            ->map(function ($article) {
                $article->url = route('articles.show', $article->slug);

                return $article;
            });
        $data['model'] = $subMenu;
        $data['parentMenu'] = $parentMenu;

        return view('admin.menus.children.create', $data);
    }

    public function update(SubMenuRequest $request, Menu $subMenu)
    {
        // dd($request->safe()->toArray());
        $this->authorize('update', $subMenu);

        $subMenu->update($request->safe()->toArray());

        return back()->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $subMenu)
    {
        $this->authorize('delete', $subMenu);

        $subMenu->delete();

        return back()->with('success', 'Menu deleted successfully.');
    }
}
