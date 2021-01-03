<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartPinjam extends Model
{
    protected $table = 'cart_pinjam';

    protected $fillable = [
        'user_id',
        'to',
        'item_id',
        'keterangan',
        'date_start',
        'date_end',
    ];

    protected $dates = [
        'date_start',
        'date_end',
        'created_at',
        'updated_at',
    ];

    public function item()
    {
        return $this->belongsTo('App\ItemPinjamDetail', 'item_id');
    }
}
