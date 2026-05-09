<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorCv extends Model
{
    protected $table      = 'mentor_cv';
    protected $primaryKey = 'id';
    public $incrementing  = false;
    protected $keyType    = 'string';
    public $timestamps    = false;

    protected $fillable = [
        'id',
        'user_id',
        'nama_lengkap',
        'email',
        'cv_url',
        'status',
        'created_at',
    ];

    public function appuser()
    {
        return $this->belongsTo(Appuser::class, 'user_id', 'id');
    }
}