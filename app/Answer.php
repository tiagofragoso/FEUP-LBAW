<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    public $timestamps = false;

    protected $table = 'answers';

    protected $primaryKey = 'question_id';

    protected $fillable = [
       'question_id', 'content'
    ];
 
    public function event() {
        return $this->belongsTo('App\Question');
    }
}
