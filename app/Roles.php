<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Roles
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property int $full_access
 * @property array $accessible_routes
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Roles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Roles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Roles query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Roles whereAccessibleRoutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Roles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Roles whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Roles whereFullAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Roles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Roles whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Roles whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Roles extends Model
{
    protected $fillable = [
        'name',
        'full_access',
        'accessible_routes',
        'description',
    ];

    protected $casts=[
        'accessible_routes'=>'array',
    ];
}
