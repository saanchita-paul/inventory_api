<?php

namespace App\Services\Product;


use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Product Add Service
 */
class ProductAddService
{
    /**
     * Add new product with stock & by default quantity is zero
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
            // Create stock for the product
            $stock = new Stock();
            $stock->product_id = $product->id;
            $stock->quantity = 0;
            $stock->unit = 'kg'; // or any other default unit you want
            $stock->save();

            return $product;
        } catch (\Throwable $th) {
            Log::error('An error occurred: ',$th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
