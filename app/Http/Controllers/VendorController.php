<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    function index()
    {
        $vendor = Vendor::all();
        return view('vendor.index', compact('vendor'));
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
                'no_hp'     => 'nullable|string|max:20',
                'email'     => 'nullable|email'
            ]
        );
        try {

            vendor::create($validated);

            return redirect()->route('vendor.index')->with('success', 'Vendor berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('vendor.index')->with('error', 'Vendor gagal ditambahkan :' . $e->getMessage());
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
        $vendor = Vendor::findOrFail($id);

        $validated = $request->validate(
            [
                'nama'      => 'required|string|max:100',
                'alamat'    => 'nullable|string',
                'no_hp'     => 'nullable|string|max:20',
                'email'     => 'nullable|email'
            ]
        );

        try {
            $vendor->update($validated);
            return redirect()->route('vendor.index')->with('success', 'Vendor berhasil diedit');
        } catch (\Exception $e) {
            return redirect()->route('vendor.index')->with('error', 'Vendor gagal diedit :' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $vendor = Vendor::where('id', $id)->first();

        if (!$vendor) {
            return redirect()->route('vendor.index')->with('error', 'Vendor not found.');
        }

        try {
            $vendor->delete();
            return redirect()->route('vendor.index')->with('success', 'Vendor deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('vendor.index')->with('error', 'Failed to delete vendor : ' . $e->getMessage());
        }
    }
}
