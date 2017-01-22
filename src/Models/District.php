<?php

namespace Cleaniquecoders\Colonies\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $fillable = [
        'state_id', 'name', 'code3',
    ];

    public function state()
    {
        return $this->belongsTo('Cleaniquecoders\Colonies\Models\State');
    }

    public function subdistricts()
    {
        return $this->hasMany('Cleaniquecoders\Colonies\Models\SubDistrict');
    }
}
