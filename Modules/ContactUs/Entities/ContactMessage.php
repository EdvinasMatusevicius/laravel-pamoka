<?php

declare(strict_types = 1);

namespace Modules\ContactUs\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Modules\ContactUs\Entities\ContactMessage
 *
 * @property int $id
 * @property string|null $client_name
 * @property string $client_email
 * @property string $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ContactMessage newModelQuery()
 * @method static Builder|ContactMessage newQuery()
 * @method static Builder|ContactMessage query()
 * @method static Builder|ContactMessage whereClientEmail($value)
 * @method static Builder|ContactMessage whereClientName($value)
 * @method static Builder|ContactMessage whereCreatedAt($value)
 * @method static Builder|ContactMessage whereId($value)
 * @method static Builder|ContactMessage whereMessage($value)
 * @method static Builder|ContactMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContactMessage extends Model
{
    protected $fillable = [
        'client_name',
        'client_email',
        'message',
    ];
}
