<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Kit;
use App\Models\KitProduct;
use Illuminate\Http\Request;

class KitsController extends Controller
{
    public function index()
    {
        $kits = Kit::with('products')->paginate(10);
        return response()->json($kits, 200);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $kit = Kit::create($request->all());
            if ($request->exists('products')) {
                foreach ($request->input('products') as $produto) {
                    KitProduct::create(
                        [
                            'kit_id' => $kit->id,
                            'product_id' => $produto
                        ]
                    );
                }
            }

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Registered successfully.'
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }

    public function destroy($id)
    {
        try {
            $kit = Kit::find($id);
            if (empty($kit)) {
                return response()->json([
                    "success" => false,
                    "message" => 'Kit not found.',
                ]);
            }

            $kit->delete();
            return response()->json([
                "success" => true,
                "message" => 'Kit deleted',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }
}
