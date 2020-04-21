<?php
declare(strict_types=1);
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductImage
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $product_id
 * @property string $file
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductImage extends Model
{
    protected $fillable = [
        'file',
        'product_id'
    ];
}
