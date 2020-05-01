<?php
declare(strict_types=1);
namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modules\Product\Entities\Product
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property float $price
 * @property bool $active
 * @property string $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Supply[] $suppliers
 * @property-read int|null $suppliers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Product whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'active',
        'type',
    ];
    protected $casts = [
        'active' => 'boolean',
    ];
    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'category_product','product_id','category_id');
    }
    public function suppliers(): BelongsToMany{
        return $this->belongsToMany(Supply::class,'supply_product');
    }
    public function images(): HasMany{
        return $this->hasMany(ProductImage::class);
    } 
}
