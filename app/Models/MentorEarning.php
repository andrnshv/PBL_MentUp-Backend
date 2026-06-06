<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorEarning extends Model
{
    protected $table = 'mentor_earnings';

    protected $guarded = [];

    public $incrementing = false;

    protected $keyType = 'string';

    public function mentor()
    {
        return $this->belongsTo(Appuser::class, 'mentor_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}   