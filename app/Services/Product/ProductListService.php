<?php

namespace App\Services\Product;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


/**
 *
 */
class ProductListService
{

    /**
     * Get all products & search by product name
     * @param Request $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Http\JsonResponse
     */
    public function list(Request $data)
    {
        try {
            return Product::query()
                ->with('category', 'stock')
                ->where('product_name', 'like', "%{$data->get('search')}%")
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
