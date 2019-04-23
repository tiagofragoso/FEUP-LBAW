<?php

namespace App\Http\Composers;
use App;
use App\Currency;
use App\Category;

class EventFormComposer {
	public function compose($view) {
		$currencies = Currency::all();
        $locale = App::getLocale();
        foreach($currencies as $c) {
            $c->symbol = $c->getSymbol($locale);
		}
		$view->with(['currencies' => $currencies, 'categories' => Category::all()]);
	}
}