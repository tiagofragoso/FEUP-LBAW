<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Participation extends Pivot
{
    public $timestamps = false;
    
    public $table = 'participations';
}


