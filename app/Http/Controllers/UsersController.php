<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.users.index", [
            "data" => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.users.new");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsersRequest $request, User $user)
    {
        $user->create([
            "first_name" => $request->input("firstname"),
            "last_name" => $request->input("lastname"),
            "email" => $request->input("email"),
            "status" => $request->input("status"),
            "hak_akses" => $request->input("access"),
            "password" => Hash::make($request->input("password")),
        ]);

        return redirect()->route("users.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("dashboard.users.detail", [
            "id" => $id,
            "data" => User::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd(User::find($id));
        return view("dashboard.users.edit", [
            "id" => $id,
            "data" => User::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            "status" => "required",
            "access" => "required",
            "password" => "min:8|nullable",
        ]);

        $user = User::find($id);
        $user->status = $request->input("status");
        $user->hak_akses = $request->input("access");
        if ($request->input("password") !== null) {
            $user->password = Hash::make($request->input("password"));
        }

        $user->save();

        return redirect()->route("users.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->back();
    }
}
