<?php

namespace App\Services\Purchase;

use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Purchase;
use App\Models\Stock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

/**
 * Purchase Add service
 */
class PurchaseAddService
{

    /**
     * Add new purchase, update stock and create record in pivot table
     * @param Request $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPurchase(Request $data)
    {
        try {
            $formattedData = $data->toArray();
            $productIds = [];

            foreach ($formattedData['products'] as $product) {
                $productIds[] = $product['id'];
            }
            $products = Product::whereIn('id', $productIds)->get();

            // Calculate the total price based on product prices and stock quantities
            $totalPrice = 0;
            foreach ($products as $product) {
                $stock = Stock::findOrFail($product->id);
                $totalPrice = $totalPrice + $product->price * $stock->quantity;
            }

            // Create a new purchase record
            $purchase = new Purchase();
            $purchase->date = $formattedData['date'];
            $purchase->invoice_no = $formattedData['invoice_no'];
            $purchase->supplier_name = $formattedData['supplier_name'];
            $purchase->grant_total = $totalPrice;
            $purchase->note = $formattedData['note'];
            $purchase->save();

            // Update the stock quantities and create product purchase records
            foreach ($formattedData['products'] as $productData) {
                $productId = $productData['id'];
                $quantity = $productData['quantity'];
                $price = $productData['price'];

                // Update the stock quantity
                $stock = Stock::findOrFail($productId);
                $stock->quantity = $quantity;
                $stock->save();

                // Update the product price
                $product = Product::findOrFail($productId);
                $product->price = $price;
                $product->save();

                $productPurchase = ProductPurchase::where('product_id', $productId)
                    ->where('purchase_id', $purchase->id)
                    ->first();

                if ($productPurchase) {
                    // If the product purchase record already exists, update it
                    $productPurchase->product_rate = $price;
                    $productPurchase->product_quantity = $quantity;
                    $productPurchase->save();
                } else {
                    // Create a new product purchase record
                    $productPurchase = new ProductPurchase();
                    $productPurchase->product_id = $productId;
                    $productPurchase->purchase_id = $purchase->id;
                    $productPurchase->product_rate = $price;
                    $productPurchase->product_quantity = $quantity;
                    $productPurchase->save();
                }
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Purchase created successfully.',
            ]);

        } catch (Exception $e) {
            Log::error('An error occurred: ', [$e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
