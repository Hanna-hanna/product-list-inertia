<?php

namespace App\Domains\Products\Actions;

use App\Domains\Products\Models\Eloquent\Product;
use Illuminate\Support\Facades\Storage;

class DeleteProduct
{

    /**
     * @param Product $product
     * @return true
     */
    public function execute(Product $product)
    {
        $product->delete();

        return true;
    }
}
