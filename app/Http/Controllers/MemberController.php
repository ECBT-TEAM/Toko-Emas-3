<?php

namespace App\Http\Controllers;

use App\Models\Member;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Database\QueryException;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['member'] = Member::all();

        return view('master-data.member.index', compact('data'));
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
    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();
        Member::create($validated);
        Alert::success('Sukses', 'Berhasil membuat member.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $data['member'] = $member;
        return view('master-data.member.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $validated = $request->validated();
        $member->update($validated);
        Alert::success('Sukses', 'Berhasil mengedit member.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        try {
            $member->delete();
            Alert::success('Sukses', 'Berhasil menghapus member.');
            return redirect()->back();
        } catch (QueryException $e) {
            Alert::error('gagal', 'Gagal menghapus member.');
            return redirect()->back();
        }
    }
}
