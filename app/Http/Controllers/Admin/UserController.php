<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FileManagement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;
use Mockery\Undefined;

class UserController extends Controller
{
    //
    public function index()
    {
        return Inertia::render(
            'Admin/Users/Index',
            [
                'users' => User::filter(
                    request(['search', 'dateStart', 'dateEnd', 'sortBy'])
                )
                    ->paginate(10)->withQueryString(),
                'filters' => Request::only(['search', 'dateStart', 'dateEnd', 'sortBy'])
            ]
        );
    }

    public function show(User $user)
    {

        return Inertia::render('Admin/Users/Show', [
            'user' => $user
        ]);
    }

    public function create()
    {

        return Inertia::render('Admin/Users/Create');
    }

    public function store(FileManagement $fileManagement)
    {
        // dd(request()->all());
        $attributes = $this->validateUser();
        if ($attributes['avatar'] ?? false) {
            $attributes['avatar'] =
                $fileManagement->uploadFile(
                    file: $attributes['avatar'] ?? false,
                    path: 'images/users/' . $attributes['email'] . '/avatar',
                );
        }

        User::create($attributes);

        return redirect('/dashboard/users')->with('success', 'Đã tạo người dùng mới!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user
        ]);
    }

    public function update($id, FileManagement $fileManagement)
    {
        // dd(request()->all());
        $user = User::find($id);
        $attributes = $this->validateUser($user);

        if ($attributes['avatar'] ?? false) {
            $attributes['avatar'] =
                $fileManagement->uploadFile(
                    file: $attributes['avatar'] ?? false,
                    deleteOldFile: true,
                    oldFile: $user->avatar,
                    path: 'images/users/' . ($user['email'] !== $attributes['email'] ? $attributes['email'] : $user['email']) . '/avatar',
                );
        }

        if ($user['email'] !== $attributes['email']) {
            $fileManagement->moveFiles(
                oldPath: 'images/users/' . $user['email'] . '/avatar',
                newPath: 'images/users/' . $attributes['email'] . '/avatar',
                deleteDirectory: 'images/users/' . $user['email']
            );
            $attributes['avatar'] = str_replace($user['email'], $attributes['email'], $user['avatar']);
        }

        $user->update($attributes);

        return back()->with('success', 'Đã cập nhật thông tin người dùng!');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Storage::deleteDirectory('images/users/' . $user['email']);

        return redirect('/dashboard/users')->with('success', 'Đã xoá người dùng!');
    }

    protected function validateUser(?User $user = null): array
    {
        $user ??= new User();

        return request()->validate([
            'name' => 'required|max:50',
            'address' => 'required|max:50',
            'avatar' => 'nullable |mimes:jpg,png | max:2096',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user)],
            'gender' => 'nullable',
            'birthday' => 'required',
            'phone_number' => 'required',
            'password' => (request()->input('password') ?? false || !$user->exists) ? 'required|confirmed|min:6' : 'nullable',

        ],);
    }
}
