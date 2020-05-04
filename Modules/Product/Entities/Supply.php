<?php

declare(strict_types = 1);

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Modules\Product\Entities\Supply
 *
 * @property int $id
 * @property string $title
 * @property string|null $logo
 * @property string $phone
 * @property string $email
 * @property string|null $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Supply newModelQuery()
 * @method static Builder|Supply newQuery()
 * @method static Builder|Supply query()
 * @method static Builder|Supply whereAddress($value)
 * @method static Builder|Supply whereCreatedAt($value)
 * @method static Builder|Supply whereEmail($value)
 * @method static Builder|Supply whereId($value)
 * @method static Builder|Supply whereLogo($value)
 * @method static Builder|Supply wherePhone($value)
 * @method static Builder|Supply whereTitle($value)
 * @method static Builder|Supply whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Supply extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'logo',
        'phone',
        'email',
        'address',
    ];
}
