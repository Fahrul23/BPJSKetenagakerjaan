<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartAmbil extends Model
{
    protected $table = 'cart_ambil';

    protected $fillable = [
        'user_id',
        'to',
        'item_id',
        'quantity',
        'keterangan'
    ];

    public function item()
    {
        return $this->belongsTo('App\ItemAmbil', 'item_id');
    }

}
