<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Article;
use App\Models\Enums\MenuLayoutEnum;
use App\Models\Menu;
use App\Models\Enums\MenuTypeEnum;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    private string $resource = 'menu';
    private string $routeResource = 'menus';

    public function index(Request $request)
    {
        $data['headers'] = [
            'Name',
            'Parent',
            'Layout',
            'Type',
            'Related To Article',
            'Url',
            'Created Date',
            'Action',
        ];
        $data['items'] = Menu::with([
            'parent:id,parent_id,name',
            'article:id,title,slug',
        ])
            ->latest()
            ->paginate(10);
        $data['resource'] = $this->resource;
        $data['routeResource'] = $this->routeResource;
        $data['title'] = __('Menus');

        return view('admin.menus.index', $data);
    }

    public function create(Request $request)
    {
        $data['title'] = __('Add new Menu');
        $data['routeResource'] = $this->routeResource;
        $data['layouts'] = MenuLayoutEnum::cases();
        $data['types'] = MenuTypeEnum::cases();
        $data['rootMenus'] = Menu::whereNull('parent_id')->get(['id as value', 'name']);
        $data['articles'] = Article::latest('id')->get(['id as value', 'title as name']);
        $data['model'] = new Menu([
            'layout' => MenuLayoutEnum::LIST,
            'type' => MenuTypeEnum::BASIC,
        ]);

        return view('admin.menus.create', $data);
    }

    public function store(MenuRequest $request)
    {
        $menu = Menu::create($request->safe()->toArray());

        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully.');
    }

    public function edit(Request $request, Menu $menu)
    {
        $this->authorize('update', $menu);

        $data['title'] = __('Edit Menu');
        $data['routeResource'] = $this->routeResource;
        $data['layouts'] = MenuLayoutEnum::cases();
        $data['types'] = MenuTypeEnum::cases();
        $data['rootMenus'] = Menu::whereNull('parent_id')->where('id', '!=', $menu->id)->get(['id as value', 'name']);
        $data['articles'] = Article::latest('id')->get(['id as value', 'title as name']);
        $data['model'] = $menu;

        return view('admin.menus.create', $data);
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $this->authorize('update', $menu);

        $menu->update($request->safe()->toArray());

        return back()->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $this->authorize('delete', $menu);

        $menu->delete();

        return back()->with('success', 'Menu deleted successfully.');
    }
}
