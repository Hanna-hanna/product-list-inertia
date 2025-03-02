<?php

namespace App\Domains\Products\Http\Resources;

use App\Domains\Products\Models\ProductInterface;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        $product = $this->resource;

        return [
            ProductInterface::FIELD_ID => $product->id,
            ProductInterface::FIELD_NAME => $product->name,
            ProductInterface::FIELD_DESCRIPTION => $product->description,
            ProductInterface::FIELD_PRICE => $product->price,
            ProductInterface::FIELD_STOCK => $product->stock,
            ProductInterface::FIELD_RANK => $product->rank,
            ProductInterface::FIELD_IMAGE => $product->image,
            ProductInterface::FIELD_CREATED_AT => Carbon::createFromFormat('Y-m-d H:i:s', $product->created_at),
            ProductInterface::FIELD_UPDATED_AT => Carbon::createFromFormat('Y-m-d H:i:s', $product->updated_at),
        ];
    }
}
