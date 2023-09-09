<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beli extends Model
{
    protected $table = 'beli';
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo('App\Barang', 'id_barang');
    }
}
