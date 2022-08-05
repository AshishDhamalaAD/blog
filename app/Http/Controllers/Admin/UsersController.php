<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Enums\UserTypeEnum;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private string $resource = 'user';
    private string $routeResource = 'users';

    public function index(Request $request)
    {
        $data['headers'] = [
            'Image',
            'Name',
            'Email',
            'Type',
            'Created At',
            'Action',
        ];
        $data['items'] = User::latest()->paginate(10);
        $data['resource'] = $this->resource;
        $data['routeResource'] = $this->routeResource;
        $data['title'] = __('Users');

        return view('admin.users.index', $data);
    }

    public function create(Request $request)
    {
        $data['title'] = __('Add new User');
        $data['routeResource'] = $this->routeResource;
        $data['types'] = UserTypeEnum::cases();
        $data['socialMedia'] = SocialMedia::select(['id', 'name'])->get();
        $data['user'] = new User([
            'type' => UserTypeEnum::NORMAL,
        ]);

        return view('admin.users.create', $data);
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->createData());

        if ($request->socialMediaUrls()->isNotEmpty()) {
            $user->socialMedia()->attach($request->socialMediaUrls());
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $data['types'] = UserTypeEnum::cases();
        $data['routeResource'] = $this->routeResource;
        $data['user'] = $user->load(['socialMedia']);
        $data['socialMedia'] = SocialMedia::select(['id', 'name'])
            ->get()
            ->map(function (SocialMedia $socialMedia) use ($user) {
                $socialMedia->url = $user->socialMedia->firstWhere('id', $socialMedia->id)->pivot->url ?? '';

                return $socialMedia;
            });

        return view('admin.users.create', $data);
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update($request->updateData($user));

        $user->socialMedia()->sync($request->socialMediaUrls());

        return back()->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->deleteImage();

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
