<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'tagu_id';
    public function memos()
    {
      return $this->belongsToMany('App\Memo','memo_tag','tagu_id','memo_id');
    }
}
