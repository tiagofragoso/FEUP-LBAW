<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public $timestamps = false;

    protected $table = 'currencies';

    public function getSymbol() {
        $locale = App::getLocale();
        $fmt = new \NumberFormatter( $locale."@currency=$this->code", \NumberFormatter::CURRENCY );
        return $fmt->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);
    }
}
