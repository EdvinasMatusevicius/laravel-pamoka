<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Product\Entities\ProductImage
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $product_id
 * @property string $file
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\ProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\ProductImage whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\ProductImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductImage extends Model
{
    protected $fillable = [
        'file',
        'product_id'
    ];
}
