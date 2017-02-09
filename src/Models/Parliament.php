<?php

namespace CleaniqueCoders\Colonies\Models;

use Illuminate\Database\Eloquent\Model;

class Parliament extends Model
{
    public function duns()
    {
        return $this->hasMany('CleaniqueCoders\Colonies\Models\Dun');
    }

    public function state()
    {
        return $this->belongsTo('CleaniqueCoders\Colonies\Models\State');
    }
}
