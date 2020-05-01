<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modules\Product\Entities\Category
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $title
 * @property string $slug
 * @property bool $active
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Product\Entities\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Category whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'active'
    ];
    protected $casts = [
        'active' => 'boolean',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
