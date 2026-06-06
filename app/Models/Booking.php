<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $guarded = [];

    public $incrementing = false;

    protected $keyType = 'string';

    public function mentor()
    {
        return $this->belongsTo(Appuser::class, 'mentor_id');
    }

    public function client()
    {
        return $this->belongsTo(Appuser::class, 'client_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id');
    }
}