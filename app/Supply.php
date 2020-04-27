<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Supply
 *
 * @property int $id
 * @property string $title
 * @property string|null $logo
 * @property string $phone
 * @property string $email
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supply query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supply whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supply whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supply whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supply wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supply whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Supply whereUpdatedAt($value)
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
