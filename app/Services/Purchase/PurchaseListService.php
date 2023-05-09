<?php

namespace App\Services\Purchase;



use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


/**
 * Purchase list service
 */
class PurchaseListService
{

    /**
     * Get all product list & search by supplier name
     * @param Request $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Http\JsonResponse
     */
    public function list(Request $data)
    {
        try {
            return Purchase::query()
                ->where('supplier_name', 'like', "%{$data->get('search')}%")
                ->orderBy('id', 'desc')
                ->paginate($data->get('per_page'));
        } catch (\Throwable $th) {
            Log::error('An error occurred: ',$th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
