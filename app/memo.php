<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class memo extends Model
{
    protected $table = 'memo';
    protected $guarded=array('id');

    public function tags()
  {
    return $this->belongsToMany('App\Tag','memo_tag','memo_id','tagu_id');
  }
}

