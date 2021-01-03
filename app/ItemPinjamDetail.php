<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ItemPinjamDetail extends Model
{
    use SoftDeletes;

    protected $table = 'item_pinjam_detail';

    protected $fillable = [
        'name', 'image', 'item_pinjam_id', 'unique_id', 'status'
    ];

    protected $attributes = [
        'image' => 'item-image/default-item.svg'
    ];

    public function uniqueID()
    {
        $unique_id = '';
        do {
            $current = $this->orderBy('id', 'DESC')->withTrashed()->first();
            $date    = str_replace('-', '', Carbon::now()->format('Y-m-d'));
            $id      = !$current ? 0 : $current->id;
            $id      = str_pad($id + 1, 3, '0', STR_PAD_LEFT);
            $prefix  = 'PMJ';

            $unique_id = implode('-', [$prefix, $date, $id]);
        } while ($this->where('unique_id', $unique_id)->get()->count() > 0);

        return $unique_id;
    }

    public function item()
    {
        return $this->belongsTo('App\ItemPinjam', 'item_pinjam_id');
    }
}
