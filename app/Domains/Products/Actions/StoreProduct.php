<?php

namespace App\Domains\Products\Actions;

use App\Domains\Products\Models\Eloquent\Product;
use App\Domains\Products\Models\ProductInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class StoreProduct
{
    /**
     * @param array $data
     * @return Product
     */
    public function execute(array $data): Product
    {
        $imageSource = Arr::get($data, 'image') ?? null;
        $image = '';
        if ($imageSource)
        {
            $preview_path = Storage::disk('uploads')->putFile('product_images', $imageSource);
            $image = basename($preview_path);
        }
        return Product::create([
            ProductInterface::FIELD_NAME => Arr::get($data, 'name'),
            ProductInterface::FIELD_DESCRIPTION => Arr::get($data, 'description'),
            ProductInterface::FIELD_PRICE => Arr::get($data, 'price'),
            ProductInterface::FIELD_STOCK => Arr::get($data, 'stock'),
            ProductInterface::FIELD_RANK => Arr::get($data, 'rank'),
            ProductInterface::FIELD_IMAGE => $image,
        ]);
    }
}
