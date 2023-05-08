<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\Product\ProductAddService;
use App\Services\Product\ProductDetailService;
use App\Services\Product\ProductListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function createProduct(ProductRequest $request)
    {
        try {
            $createProduct = new ProductAddService();
            $product = $createProduct->addProduct($request);
            if ($product) {
//                return ProductResource::make($product);
                return $product;
            } else {
                return 'Product not created';
            }
        }
        catch (\Throwable $th) {
            Log::error('An error occurred: ',$th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function viewProduct($id)
    {
        try {
            $productDetails = new ProductDetailService();
            return $productDetails->singleProduct($id);
        }
        catch (\Throwable $th) {
            Log::error('An error occurred: ',$th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function productList(Request $data)
    {
        try {
            $productList = new ProductListService();
            return $productList->list($data);
        }
        catch (\Throwable $th) {
            Log::error('An error occurred: ',$th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
