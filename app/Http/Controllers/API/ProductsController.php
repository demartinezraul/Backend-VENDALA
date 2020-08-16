<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    /**
     * Returns all users - paginated
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::paginate(10);

        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required',
                'images' => 'required',
                'images.*' => 'image|max:2048|mimes:jpeg,png,jpg'
            ]);

            $product = Product::create(
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'category' => $request->category
                ]
            );

            if ($request->images) {
                foreach ($request->images as $image) {
                    ProductImage::create(
                        [
                            'product_id' => $product->id,
                            'archive' => $image
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
            $product = Product::find($id);
            if (empty($product)) {
                return response()->json([
                    "success" => false,
                    "message" => 'Product not found.',
                ]);
            }

            $product->delete();
            return response()->json([
                "success" => true,
                "message" => 'Product deleted',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }
}
