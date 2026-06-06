<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}