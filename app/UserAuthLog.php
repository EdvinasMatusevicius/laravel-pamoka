<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


/**
 * App\UserAuthLog
 *
 * @property int $id
 * @property int $user_id
 * @property string $token_id
 * @property Carbon $event_time
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|UserAuthLog newModelQuery()
 * @method static Builder|UserAuthLog newQuery()
 * @method static Builder|UserAuthLog query()
 * @method static Builder|UserAuthLog whereCreatedAt($value)
 * @method static Builder|UserAuthLog whereEventTime($value)
 * @method static Builder|UserAuthLog whereId($value)
 * @method static Builder|UserAuthLog whereTokenId($value)
 * @method static Builder|UserAuthLog whereType($value)
 * @method static Builder|UserAuthLog whereUpdatedAt($value)
 * @method static Builder|UserAuthLog whereUserId($value)
 * @mixin \Eloquent
 */
class UserAuthLog extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'token_id',
        'event_time',
        'type',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'event_time',
    ];

    
}