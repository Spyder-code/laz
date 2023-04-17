<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\DonaturService;
use App\Repositories\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService, $donaturService;
    public function __construct(UserService $userService, DonaturService $donaturService)
    {
        $this->userService = $userService;
        $this->donaturService = $donaturService;
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
        $donatur = $this->donaturService->getAvailable();
        return view('admin.user.donatur', compact('user','donatur'));
    }

    public function addDonatur(Request $request, User $user)
    {
        $this->userService->addDonatur($request->all(),$user->id);
        return back()->with('success','Donatur berhasil ditambahkan');
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
        return back()->with('success', 'User updated successfully');
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
