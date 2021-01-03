<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengambilan extends Model
{
    use SoftDeletes;
    
    protected $table    = 'pengambilan';

    protected $fillable = ['user_id'];

    protected $dates    = ['deleted_at', 'created_at', 'updated_at'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function pengambilans() {
        return $this->hasMany('App\PengambilanDetail', 'pengambilan_id', 'id');
    }

}
