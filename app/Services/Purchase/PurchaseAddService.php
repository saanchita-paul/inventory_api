<?php

namespace App\Services\Purchase;

use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Purchase;
use App\Models\Stock;
use Exception;
use Illuminate\Http\Request;
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
                $totalPrice += $product->price * $stock->quantity;
            }

            // Create a new purchase record
            $purchase = new Purchase();
            $purchase->date = $data->date;
            $purchase->invoice_no = $data->invoice_no;
            $purchase->supplier_name = $data->supplier_name;
            $purchase->grant_total = $totalPrice;
            $purchase->note = $data->note;
            $purchase->status = $data->status;
            $purchase->save();

            // Update the stock quantities and create product purchase records
            foreach ($formattedData['products'] as $product) {
                $product = Product::findOrFail($product['id']);

                // Update the stock quantity
                $stock = Stock::findOrFail($product->id);
                $stock->quantity += $data->quantity;
                $stock->save();

                $productPurchase = ProductPurchase::whereIn('product_id', $productIds)
                    ->where('purchase_id', $purchase->id)
                    ->first();
                if ($productPurchase) {
                    // If the product purchase record already exists, update it
                    $productPurchase->product_rate = $product->price;
                    $productPurchase->product_quantity += $data->quantity;
                    $productPurchase->save();
                } else {
                    // Create a new product purchase record
                    $productPurchase = new ProductPurchase();
                    $productPurchase->product_id = $product->id;
                    $productPurchase->purchase_id = $purchase->id;
                    $productPurchase->product_rate = $product->price;
                    $productPurchase->product_quantity = $data->quantity;
                    $productPurchase->save();
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Purchase created successfully.',
            ]);

        } catch (Exception $e) {
            Log::error('An error occurred: ', $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


}
