<?php

namespace App\Http\Composers;
use App\Currency;
use App\Category;

class EventFormComposer {
	public function compose($view) {
		$currencies = Currency::all();
        foreach($currencies as $c) {
            $c->symbol = $c->getSymbol();
		}
		$view->with(['currencies' => $currencies, 'categories' => Category::all()]);
	}
}