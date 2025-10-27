<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderByDesc('id')->get();
        return view('members.index', compact('members'));
    }

    public function create() { return view('members.create'); }
    public function store(Request $request)
    {
        Member::create($request->only(['name','email','contact']));
        return redirect()->route('members.index')->with('success','Member created.');
    }
    public function edit(Member $member) { return view('members.edit', compact('member')); }
    public function update(Request $request, Member $member)
    {
        $member->update($request->only(['name','email','contact']));
        return redirect()->route('members.index')->with('success','Member updated.');
    }
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success','Member deleted.');
    }
}
