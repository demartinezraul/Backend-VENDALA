<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    /**
     * Returns all products - paginated
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::with('productImages')->with('kit')->with('category')->paginate(10);

        return response()->json($products, 200);
    }

    public function store(CreateProductRequest $request)
    {
        try {
            $product = Product::create(
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'category_id' => $request->category_id
                ]
            );

            if ($request->images) {
                foreach ($request->images as $image) {
                    $baseFileName = mb_strtolower($image->getClientOriginalName());
                    $ext = strtolower($image->getClientOriginalExtension());
                    $filenameWithoutExt = preg_replace("~\." . $ext . "$~i", '', $baseFileName);
                    $filename = str_slug($filenameWithoutExt) . '_' . date('YmdHis') . '.' . $ext;
                    $imagePath = Storage::disk('local')->putFileAs('products'.'/'.$product->id, $image, $filename);
                    if($imagePath) {
                        ProductImage::create(
                            [
                                'product_id' => $product->id,
                                'archive' => $imagePath
                            ]
                        );
                    }
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
