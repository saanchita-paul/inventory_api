<?php

namespace App\Http\Controllers\Api\Purchase;

use App\Http\Controllers\Controller;

use App\Http\Requests\Purchase\PurchaseRequest;
use App\Http\Resources\StockResource;
use App\Services\Purchase\PurchaseAddService;
use App\Services\Purchase\PurchaseListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PurchaseController extends Controller
{
    public function createPurchase(PurchaseRequest $request)
    {
        try {
            $createPurchase = new PurchaseAddService();
            $purchase = $createPurchase->addPurchase($request);
            if ($purchase) {
//                return StockResource::make($purchase);
                return $purchase;
            } else {
                return 'Purchase not created';
            }
        }
        catch (\Throwable $th) {
            Log::error('An error occurred: ',$th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    public function purchaseList(Request $data)
    {
        try {
            $productList = new PurchaseListService();
            return $productList->list($data);
        }
        catch (\Throwable $th) {
            Log::error('An error occurred: ',$th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
