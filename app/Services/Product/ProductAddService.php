<?php

namespace App\Services\Product;


use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

/**
 *
 */
class ProductAddService
{
    /**
     * User Login Service
     * @param Request $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function addProduct(Request $data)
    {
        try {
            $product = new Product;
            $product->product_name = $data->product_name;
            $product->category_id = $data->category_id;
            $product->description = $data->description;
            $product->price = $data->price;
            $product->image = $data->image;
            $product->save();
            return $product;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
