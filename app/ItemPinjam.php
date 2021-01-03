<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ItemPinjam extends Model
{
    use SoftDeletes;

    protected $table = 'item_pinjam';

    protected $fillable = [
        'name', 'image', 'category_id'
    ];

    protected $attributes = [
        'image' => 'item-image/default-item.svg'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function items()
    {
        return $this->hasMany('App\ItemPinjamDetail');
    }

    /**
     *  Accessor
     *
     *  Merubah data saat di panggil
     */

    // public function getCreatedAtAttribute($value)
    // {
    //     return Carbon::parse($value);
    // }
}
