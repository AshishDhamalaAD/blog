<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{
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
        $data['users'] = User::latest()->paginate(10);

        return view('admin.users.index', $data);
    }

    public function create(Request $request)
    {
        $data['types'] = UserTypeEnum::cases();
        $data['user'] = new User([
            'type' => UserTypeEnum::NORMAL,
        ]);

        return view('admin.users.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['bail', 'nullable', 'image', 'max:1024'],
            'name' => ['bail', 'required', 'string', 'max:255'],
            'email' => ['bail', 'required', 'email', 'max:255', Rule::unique(User::class)],
            'password' => ['bail', 'required', 'string', Password::defaults(), 'confirmed'],
            'description' => ['bail', 'required', 'string', 'min:10'],
            'type' => ['bail', 'required', Rule::in(UserTypeEnum::values())],
        ]);

        $validated['password'] = Hash::make($request->password);

        if ($request->image) {
            $validated['image'] = $request->file('image')->store('images');
        }

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(Request $request, User $user)
    {
        $data['types'] = UserTypeEnum::cases();
        $data['user'] = $user;

        return view('admin.users.create', $data);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'image' => ['bail', 'nullable', 'image', 'max:1024'],
            'name' => ['bail', 'required', 'string', 'max:255'],
            'email' => ['bail', 'required', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'password' => ['bail', 'nullable', 'string', Password::defaults(), 'confirmed'],
            'description' => ['bail', 'required', 'string', 'min:10'],
            'type' => ['bail', 'required', Rule::in(UserTypeEnum::values())],
        ]);

        $validated['password'] = $request->password ? Hash::make($request->password) : $user->password;

        if ($request->image) {
            $user->deleteImage();

            $validated['image'] = $request->file('image')->store('images');
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->deleteImage();

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
