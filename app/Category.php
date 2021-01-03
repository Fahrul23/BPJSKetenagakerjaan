<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'Category';

    protected $fillable = ['category'];

    public function item()
    {
        return $this->hasManyThrough('App\ItemPinjamDetail', 'App\ItemPinjam');
    }
}
