<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeminjamanDetail extends Model
{
    use SoftDeletes;

    protected $table    = 'peminjaman_detail';

    protected $fillable = [
        'items_id',
        // 'quantity',
        'keterangan',
        // 'deleted_at',
        // 'created_at',
        // 'updated_at',
        'confirmed_at',
        'returned_at',
        'date_start',
        'date_end'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'confirmed_at',
        'returned_at',
        'date_start',
        'date_end',
    ];

    public function peminjamanable()
    {
        return $this->morphTo();
    }

    public function peminjaman()
    {
        return $this->morphOne('App\PeminjamanDetail', 'peminjamanable');
    }

    public function item()
    {
        return $this->hasOne('App\ItemPinjamDetail', 'id', 'items_id');
    }

    public function getStatusAttribute() 
    {
        $is_change = $this->peminjaman;

        switch (true) {
            case !empty($this->confirmed_at):
                $status = ['disetujui', 'success'];
                break;
            case !empty($this->deleted_at):
                $status = ['ditolak', 'danger'];
                break;
            case !empty($is_change):
                $status = ['diganti', 'primary'];
                break;

            default:
                $status = null;
                break;
        }

        return $status;
    }
}
