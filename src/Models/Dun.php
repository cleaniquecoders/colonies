<?php

namespace CleaniqueCoders\Colonies\Models;

use Illuminate\Database\Eloquent\Model;

class Dun extends Model
{
    public function state()
    {
        return $this->belongsTo('CleaniqueCoders\Colonies\Models\State');
    }

    public function parliament()
    {
        return $this->belongsTo('CleaniqueCoders\Colonies\Models\Parliamnet');
    }
}
