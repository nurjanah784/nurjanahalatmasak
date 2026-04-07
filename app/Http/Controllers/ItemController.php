<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        // Check if user is admin or petugas
        if (in_array(Auth::user()->role, ['admin', 'petugas'])) {
            $items = Item::all();
        } else {
            $items = Item::where('status', 'available')->get();
        }
        
        return view('item', compact('items'));
    }
    
    public function handle(Request $request, $itemId = null)
    {
        if ($request->isMethod('get')) {
            $items = Item::all();
            return view('item', compact('items'));
        }

        if ($request->isMethod('post')) {
            // Validasi input
            $request->validate([
                'name' => 'required',
                'description' => 'nullable',
                'stock' => 'required|integer|min:1',
                'kondisi' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $data = $request->all();
            
            // Handle upload gambar
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $image->getClientOriginalName());
                $image->move(public_path('assets/img'), $imageName);
                $data['foto'] = 'assets/img/' . $imageName;
            } else {
                $data['foto'] = null;
            }

            if (Item::create($data)) {
                return back()->with('success', 'Barang berhasil ditambahkan.');
            } else {
                return back()->with('error', 'Terjadi kesalahan saat menambahkan barang.');
            }
        }

        if ($request->isMethod('put') && $itemId) {
            // Validasi input
            $request->validate([
                'name' => 'required',
                'description' => 'nullable',
                'stock' => 'required|integer|min:1',
                'kondisi' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $item = Item::findOrFail($itemId);
            
            $data = $request->all();
            
            if ($request->hasFile('image')) {
                if ($item->foto && file_exists(public_path($item->foto))) {
                    unlink(public_path($item->foto));
                }
                
                $image = $request->file('image');
                $imageName = time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $image->getClientOriginalName());
                $image->move(public_path('assets/img'), $imageName);
                $data['foto'] = 'assets/img/' . $imageName;
            }

            if ($item->update($data)) {
                return back()->with('success', 'Barang berhasil diperbarui.');
            } else {
                return back()->with('error', 'Terjadi kesalahan saat memperbarui barang.');
            }
        }

        if ($request->isMethod('delete') && $itemId) {
            try {
                $item = Item::findOrFail($itemId);
                
                if ($item->foto && file_exists(public_path($item->foto))) {
                    unlink(public_path($item->foto));
                }

                $item->delete();
                return back()->with('success', 'Barang berhasil dihapus.');
            } catch (\Exception $e) {
                return back()->with('error', 'Terjadi kesalahan saat menghapus barang.');
            }
        }

        return back()->with('error', 'Aksi tidak diizinkan.');
    }
}