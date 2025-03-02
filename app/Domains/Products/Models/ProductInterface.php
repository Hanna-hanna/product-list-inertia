<?php

namespace App\Domains\Products\Models;
interface ProductInterface
{
    const TABLE_NAME = 'products';
    const FIELD_ID = 'id';
    const FIELD_NAME = 'name';
    const FIELD_DESCRIPTION = 'description';
    const FIELD_PRICE = 'price';
    const FIELD_STOCK = 'stock';
    const FIELD_RANK = 'rank';
    const FIELD_IMAGE = 'image';
    const FIELD_CREATED_AT = 'created_at';
    const FIELD_UPDATED_AT = 'updated_at';
}
