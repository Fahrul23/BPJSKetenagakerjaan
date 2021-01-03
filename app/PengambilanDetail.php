<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengambilanDetail extends Model
{
    use SoftDeletes;

    protected $table = 'pengambilan_detail';

    protected $fillable = [
        'items_id',
        'quantity',
        'status',
        'confirmed_at',
        'deleted_at', 
        'created_at', 
        'updated_at'
    ];

    public function item() {
        return $this->belongsTo('App\ItemAmbil', 'items_id');
    }

    public function pengambilan() {
        return $this->belongsTo('App\Pengambilan', 'pengambilan_id');
    }
    
    public function getStatusAttribute() {

        switch (true) {
            case !empty($this->confirmed_at):
                $status = ['disetujui', 'success'];
                break;
            case !empty($this->deleted_at):
                $status = ['ditolak', 'danger'];
                break;

            default:
                $status = null;
                break;
        }

        return $status;
    }

}
