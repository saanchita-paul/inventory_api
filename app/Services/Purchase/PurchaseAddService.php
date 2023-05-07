<?php

namespace App\Services\Purchase;

use App\Models\Purchase;
use Exception;
use Illuminate\Http\Request;

/**
 *
 */
class PurchaseAddService
{
    /**
     * User Login Service
     * @param Request $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPurchase(Request $data)
    {
        try {
            $purchase = new Purchase();
            $purchase->product_id = $data->product_id;
            $purchase->quantity = $data->quantity;
            $purchase->unit = $data->unit;
            $purchase->note = $data->note;
            $purchase->save();
            return $purchase;

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


}
