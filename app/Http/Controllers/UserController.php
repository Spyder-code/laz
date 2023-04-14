<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('admin.user.index');
    }


    public function create()
    {
        return view('admin.user.create');
    }


    public function store(UserRequest $request)
    {
        if($request['password']!=null) {
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);
        }
        $this->userService->store($request->all());
        return redirect()->route('user.index')->with('success', 'User has been created');
    }


    public function show(User $user)
    {
        return view('admin.user.donatur', compact('user'));
    }


    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }


    public function update(UserRequest $request, User $user)
    {
        if($request['password']!=null) {
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);
        }
        $this->userService->update($request->all(), $user->id);
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }


    public function destroy(User $user)
    {
        $this->userService->delete($user->id);
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }

    public function dataTable()
    {
        return $this->userService->dataTable();
    }
}
