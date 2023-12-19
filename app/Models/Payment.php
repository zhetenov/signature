<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Payment.
 */
final class Payment extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'gateway', 'payment_id', 'status', 'amount', 'amount_paid', 'timestamp', 'additional_info'
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getAdditionalInfoAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * @param $value
     * @return void
     */
    public function setAdditionalInfoAttribute($value)
    {
        $this->attributes['additional_info'] = json_encode($value);
    }
}
