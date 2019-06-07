<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    public $timestamps = false;

    protected $table = 'tickets';


    protected $fillable = [
       'qrcode', 'owner','price','event_id'
    ];

    public function event() {
        return $this->belongsTo('App\Event');
    }

}
