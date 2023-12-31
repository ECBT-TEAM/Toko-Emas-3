<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Cabang;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['user'] = User::with(['cabang', 'role'])->get();
        $data['cabang'] = Cabang::all();
        $data['role'] = Role::all();
        return view('master-data.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        User::create([
            'nama' => $validated['nama'],
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
            'cabang_id' => $validated['cabang'],
            'role_id' => $validated['role'],
        ]);

        Alert::success('Sukses', 'Berhasil membuat user.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data['cabang'] = Cabang::all();
        $data['role'] = Role::all();
        $data['user'] = $user;
        return view('master-data.user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated  = $request->validated();

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
            $user->update([
                'password' => $validated['password'],
            ]);
        } else {
            unset($validated['password']);
        }

        $user->update([
            'nama' => $validated['nama'],
            'username' => $validated['username'],
            'cabang_id' => $validated['cabang'],
            'role_id' => $validated['role'],
        ]);

        $user->save();

        Alert::success('Sukses', 'Berhasil mengedit user.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            Alert::success('Sukses', 'Berhasil menghapus user.');
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('Gagal', 'User sedang digunakan dalam transaksi.');
            return redirect()->back();
        }
    }
}
