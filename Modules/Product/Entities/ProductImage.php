<?php

declare(strict_types = 1);

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class ProductImage
 *
 * @package Modules\Product\Entities
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $product_id
 * @property string $file
 * @method static Builder|ProductImage newModelQuery()
 * @method static Builder|ProductImage newQuery()
 * @method static Builder|ProductImage query()
 * @method static Builder|ProductImage whereCreatedAt($value)
 * @method static Builder|ProductImage whereFile($value)
 * @method static Builder|ProductImage whereId($value)
 * @method static Builder|ProductImage whereProductId($value)
 * @method static Builder|ProductImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductImage extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'file',
    ];
}
