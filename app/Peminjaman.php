<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjaman extends Model
{
    use SoftDeletes;

    protected $table    = 'peminjaman';

    protected $fillable = ['user_id'];

    protected $dates = [
        'created_at',
        'date_start',
        'date_end',
        'updated_at'
    ];

    public function peminjamans()
    {
        return $this->morphMany('App\PeminjamanDetail', 'peminjamanable');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
