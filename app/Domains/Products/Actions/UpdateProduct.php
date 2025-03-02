<?php

namespace App\Domains\Products\Actions;

use App\Domains\Products\Models\Eloquent\Product;
use App\Domains\Products\Models\ProductInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class UpdateProduct
{
    /**
     * @param array $data
     * @return Product
     */
    public function execute(Product $product, array $data): Product
    {
        $image = null;
        if (Arr::get($data, 'image'))
        {
            $preview_path = Storage::disk('uploads')->putFile('products_images', Arr::get($data, 'image'));
            $image = basename($preview_path);
        }

        if ($image) {
            $product->update([
                ProductInterface::FIELD_IMAGE => $image,
            ]);
        }

        $product->update([
            ProductInterface::FIELD_NAME => Arr::get($data, 'name'),
            ProductInterface::FIELD_DESCRIPTION => Arr::get($data, 'description'),
            ProductInterface::FIELD_PRICE => Arr::get($data, 'price'),
            ProductInterface::FIELD_STOCK => Arr::get($data, 'stock'),
            ProductInterface::FIELD_RANK => Arr::get($data, 'rank'),
        ]);

        return $product;
    }
}
