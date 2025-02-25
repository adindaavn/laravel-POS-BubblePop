<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{

    function index()
    {
        $penerbit = Penerbit::all();
        return view('penerbit.index', compact('penerbit'));
    }
    public function create()
    {
        //
    }

    function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama'      => 'required|string|max:100',
                'alamat'    => 'nullable|string',
                'no_telp'     => 'nullable|string|max:20',
                'email'     => 'nullable|email'
            ]
        );

        try {

            penerbit::create($validated);

            return redirect()->route('penerbit.index')->with('success', 'penerbit berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('penerbit.index')->with('error', 'penerbit gagal ditambahkan :' . $e->getMessage());
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
        $penerbit = Penerbit::findOrFail($id);

        $validated = $request->validate(
            [
                'nama'      => 'required|string|max:100',
                'alamat'    => 'nullable|string',
                'no_telp'     => 'nullable|string|max:20',
                'email'     => 'nullable|email'
            ]
        );

        try {
            $penerbit->update($validated);
            return redirect()->route('penerbit.index')->with('success', 'penerbit berhasil diedit');
        } catch (\Exception $e) {
            return redirect()->route('penerbit.index')->with('error', 'penerbit gagal diedit :' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $penerbit = Penerbit::where('id', $id)->first();

        if (!$penerbit) {
            return redirect()->route('penerbit.index')->with('error', 'penerbit not found.');
        }

        try {
            $penerbit->delete();
            return redirect()->route('penerbit.index')->with('success', 'penerbit deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('penerbit.index')->with('error', 'Failed to delete penerbit : ' . $e->getMessage());
        }
    }
}
