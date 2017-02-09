<?php

namespace CleaniqueCoders\Colonies\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $fillable = [
        'name', 'name_long', 'code2', 'code3', 'capital',
    ];

    public function districts()
    {
        return $this->hasMany('CleaniqueCoders\Colonies\Models\District');
    }

    public function parliaments()
    {
        return $this->hasMany('App\Parliament');
    }

    public function duns()
    {
        return $this->hasMany('App\Dun');
    }
}
