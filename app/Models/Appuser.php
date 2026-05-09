<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appuser extends Model
{
    protected $table      = 'appuser';
    protected $primaryKey = 'id';
    public $incrementing  = false;
    protected $keyType    = 'string';
    public $timestamps    = false;

    protected $fillable = [
        'id',
        'nama_lengkap',
        'username',
        'email',
        'role',
        'created_at',
    ];

    public function bioProfil()
    {
        return $this->hasOne(BioProfil::class, 'email', 'email');
    }
}