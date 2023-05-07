<?php

namespace App\Http\Controllers\Api\Purchase;

use App\Http\Controllers\Controller;

use App\Http\Requests\Purchase\PurchaseRequest;
use App\Http\Resources\CurrentStockResource;
use App\Services\Purchase\PurchaseAddService;
use Exception;


class PurchaseController extends Controller
{
    public function createPurchase(PurchaseRequest $request)
    {
        try {
            $createPurchase = new PurchaseAddService();
            $purchase = $createPurchase->addPurchase($request);
            if ($purchase) {
                return CurrentStockResource::make($purchase);
            } else {
                return 'Purchase not created';
            }
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

}
