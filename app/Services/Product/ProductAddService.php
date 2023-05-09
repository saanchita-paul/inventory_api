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
            $stock = $this->addStock($product->id, $data->unit);

            return response()->json([
                'status' => true,
                'product' => $product,
                'stock' => $stock
            ]);

        } catch (\Throwable $th) {
            Log::error('An error occurred: ',$th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    /**
     * @param $productId
     * @param $unit
     * @return Stock
     */
    public function addStock($productId, $unit)
    {
        $product = Product::findOrFail($productId);
        $stock = new Stock();
        $stock->product_id = $product->id;
        $stock->quantity = 0;
        $stock->unit = $unit;
        $stock->save();
        return $stock;
    }

}
