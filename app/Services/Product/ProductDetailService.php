<?php

namespace App\Services\Product;


use App\Models\Product;
use Illuminate\Support\Facades\Log;


/**
 * Product Details Service
 */
class ProductDetailService
{

    /**
     * get single product by id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function singleProduct($id)
    {
        try {
            return Product::where('id',$id)->with('category')->firstOrFail();
        } catch (\Throwable $th) {
            Log::error('An error occurred: ',$th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
