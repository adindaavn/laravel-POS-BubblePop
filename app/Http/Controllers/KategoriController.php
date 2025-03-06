<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Exception;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }
    public function create()
    {
        //
    }

    function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama' => 'required|string|min:0|max:50'
            ]
        );
        try {

            Kategori::create($validated);

            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('kategori.index')->with('error', 'Kategori gagal ditambahkan :' . $e->getMessage());
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
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate(
            [
                'nama' => 'required|string|min:0|max:50'
            ]
        );

        try {

            $kategori->update($validated);

            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diedit');
        } catch (\Exception $e) {
            return redirect()->route('kategori.index')->with('error', 'Kategori gagal diedit :' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $kategori = Kategori::where('id', $id)->first();

        if (!$kategori) {
            return redirect()->route('kategori.index')->with('error', 'Kategori not found.');
        }
        
        try {
            $kategori->delete();
            return redirect()->route('kategori.index')->with('success', 'Kategori deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('kategori.index')->with('error', 'Failed to delete kategori : ' . $e->getMessage());
        }
    }
}
