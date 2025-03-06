<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    function index()
    {
        $member = Member::all();
        return view('member.index', compact('member'));
    }
    public function create()
    {
        //
    }

    function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama' => 'required|string|max:100',
                'alamat' => 'string',
                'no_telp' => 'string|max:20',
                'email' => 'string'
            ]
        );
        try {
            Member::create($validated);
            return redirect()->route('member.index')->with('success', 'member berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('member.index')->with('error', 'member gagal ditambahkan :' . $e->getMessage());
        }
    }
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $validated = $request->validate(
            [
                'nama' => 'required|string|max:100',
                'alamat' => 'string',
                'no_telp' => 'string|max:20',
                'email' => 'string'
            ]
        );

        try {
            $member->update($validated);
            return redirect()->route('member.index')->with('success', 'member berhasil diedit');
        } catch (\Exception $e) {
            return redirect()->route('member.index')->with('error', 'member gagal diedit :' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $member = Member::where('id', $id)->first();

        if (!$member) {
            return redirect()->route('member.index')->with('error', 'member not found.');
        }

        try {
            $member->delete();
            return redirect()->route('member.index')->with('success', 'member deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('member.index')->with('error', 'Failed to delete member : ' . $e->getMessage());
        }
    }
}
