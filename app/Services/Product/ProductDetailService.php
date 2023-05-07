<?php

namespace App\Services\Product;


use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

/**
 *
 */
class ProductDetailService
{

    public function singleProduct($id)
    {
        try {
            return Product::where('id',$id)->with('category')->firstOrFail();
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
