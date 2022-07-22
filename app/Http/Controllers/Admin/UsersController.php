<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $data['headers'] = [
            'Image',
            'Name',
            'Email',
            'Created At',
            'Action',
        ];
        $data['users'] = User::latest()->paginate(10);

        return view('admin.users.index', $data);
    }
}
