<?php

namespace App\Services\Product;


use App\Models\Product;
use Exception;
use Illuminate\Http\Request;


/**
 *
 */
class ProductListService
{

    public function list(Request $data)
    {
        try {
            return Product::query()
                ->where('product_name', 'like', "%{$data->get('search')}%")
                ->paginate($data->get('per_page'));
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
