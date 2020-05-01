<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Product\Entities\Supply
 *
 * @property int $id
 * @property string $title
 * @property string|null $logo
 * @property string $phone
 * @property string $email
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Supply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Supply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Supply query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Supply whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Supply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Supply whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Supply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Supply whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Supply wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Supply whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Product\Entities\Supply whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Supply extends Model
{
    protected $fillable =[
        'title',
        'logo',
        'phone',
        'email',
        'address',
    ];
}
