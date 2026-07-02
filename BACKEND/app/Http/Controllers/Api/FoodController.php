<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    // GET /foods
    // GET /admin/foods
    public function index(Request $request)
    {
        if ($request->has('search')) {

            $search = $request->query('search');

            $food = Food::where(
                'nama_makanan',
                'like',
                '%' . $search . '%'
            )->first();

            if (!$food) {
                return response()->json([
                    'message' => 'Makanan tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'id' => $food->id,
                'nama_makanan' => $food->nama_makanan,
                'kalori_standar' => $food->kalori_standar,
                'satuan_standar' => $food->satuan_standar,
            ], 200);
        }

        $foods = Food::all();

        return response()->json([
            'success' => true,
            'data' => $foods
        ], 200);
    }

    // POST /admin/foods
    public function store(Request $request)
    {
        $request->validate([
            'nama_makanan' => 'required',
            'kalori_standar' => 'required|numeric',
            'satuan_standar' => 'required',
        ]);

        $food = Food::create([
            'nama_makanan' => $request->nama_makanan,
            'kalori_standar' => $request->kalori_standar,
            'satuan_standar' => $request->satuan_standar,
        ]);

        return response()->json([
            'success' => true,
            'data' => $food
        ]);
    }

    // PUT /admin/foods/{id}
    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id);

        $food->update([
            'nama_makanan' => $request->nama_makanan,
            'kalori_standar' => $request->kalori_standar,
            'satuan_standar' => $request->satuan_standar,
        ]);

        return response()->json([
            'success' => true,
            'data' => $food
        ]);
    }

    // DELETE /admin/foods/{id}
    public function destroy($id)
    {
        $food = Food::findOrFail($id);

        $food->delete();

        return response()->json([
            'success' => true,
            'message' => 'Makanan berhasil dihapus'
        ]);
    }
}