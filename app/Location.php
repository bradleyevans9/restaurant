<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    //
    use SoftDeletes;

    public function rooms()
    {
        return $this->hasMany(Room::class, 'room_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(Location::class, 'id', 'parent_id');
    }

    public function getParentLabelAttribute() {
        if (isset($this->parent->label)) {
            return $this->parent->label;
        } else {
            return 'N/A';
        }
    }

    public function getParentNameAttribute() {
        if (isset($this->parent->name)) {
            return $this->parent->name;
        } else {
            return 'N/A';
        }
    }
}
