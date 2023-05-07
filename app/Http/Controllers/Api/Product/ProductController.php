<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\Product\ProductAddService;
use App\Services\Product\ProductDetailService;
use App\Services\Product\ProductListService;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createProduct(ProductRequest $request)
    {
        try {
            $createProduct = new ProductAddService();
            $product = $createProduct->addProduct($request);
            if ($product) {
                return ProductResource::make($product);
            } else {
                return 'Product not created';
            }
        }
        catch (\Throwable $th) {
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
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
