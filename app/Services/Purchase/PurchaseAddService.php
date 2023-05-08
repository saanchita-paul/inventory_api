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
            $product = Product::findOrFail($data->product_id);

            // Update the stock quantity
            $stock = Stock::findOrFail($data->product_id);
            $stock->quantity += $data->quantity;
            $stock->save();

            // Create a new purchase record
            $purchase = new Purchase();
            $purchase->date = $data->date;
            $purchase->invoice_no = $data->invoice_no;
            $purchase->supplier_name = $data->supplier_name;
            $purchase->grant_total = $data->grant_total;
            $purchase->note = $data->note;
            $purchase->status = $data->status;
            $purchase->save();
            $productPurchase = ProductPurchase::where('product_id', $product->id)
                ->where('purchase_id', $purchase->id)
                ->first();
            if ($productPurchase) {
                // If the product purchase record already exists, update it
                $productPurchase->product_rate = $data->grant_total;
                $productPurchase->product_quantity += $data->quantity;
                $productPurchase->save();
            } else {
                // Create a new product purchase record
                $productPurchase = new ProductPurchase();
                $productPurchase->product_id = $product->id;
                $productPurchase->purchase_id = $purchase->id;
                $productPurchase->product_rate = $data->grant_total;
                $productPurchase->product_quantity = $data->quantity;
                $productPurchase->save();
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
