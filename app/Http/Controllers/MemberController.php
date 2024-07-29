<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members',
            'phone' => 'required|string|max:15',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'study' => 'required|in:SD,SMP,SMA/SMK,Others',
        ]);

        $userId = Auth::id();

        $memberData = array_merge($validated, ['user_id' => $userId]);

        Member::create($memberData);

        return response()->json(['success' => 'Member has been added successfully.']);
    }

    public function edit($userId)
    {
        $member = Member::whereHas('user')->where('user_id', $userId)->first();

        if (!$member) {
            return redirect()->route('frontend.index')->with('error', 'Member not found');
        }

        return view('frontend.edit-member', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'city' => 'required|string|max:100',
            'study' => 'required|string|max:100',
        ]);

        $member = Member::find($id);

        if (!$member) {
            return response()->json(['error' => 'Member not found'], 404);
        }

        $member->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'city' => $request->input('city'),
            'study' => $request->input('study'),
        ]);

        return response()->json(['success' => 'Member has been updated successfully.']);
    }
}
