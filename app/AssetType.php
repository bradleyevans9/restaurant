<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class AssetType extends Model implements Auditable
{   /*
    Currently the donation type label is stored in Donations.donation_description. The label field has a unique index.
    The label functions as a shortname and should be considered a foreign key relationship to Donations.donation_description.
    TODO: create and enforce fk relationship such that if the label is edited the changes cascade down into Donations.donation_description.
    To prevent data loss, when a donation type becomes inactive, the inactive type should be added to the list of active donation types and preserved (not set to null).
    Similarly, if a donation type is deleted, some thought should be given as to how the donation_description is going to be handled.
    Previously, when removing a donation type, a note was added indicating the previous donation type. All Donations should have a donation description (null is not allowed).
    The name field is more of a longer description to be used in reports.  The value field refers to the Quickbooks chart of accounts number.
    */
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'asset_type';

    public function scopeActive($query)
    {
        return $query->whereIsActive(1);
    }

    public function parent_asset_type()
    {
        return $this->hasOne(AssetType::class, 'id', 'parent_asset_type_id');
    }

    public function getParentLabelAttribute() {
        if (isset($this->parent_asset_type->label)) {
            return $this->parent_asset_type->label;
        } else {
            return 'N/A';
        }
    }


    public function getParentNameAttribute() {
        if (isset($this->parent_asset_type->name)) {
            return $this->parent_asset_type->name;
        } else {
            return 'N/A';
        }
    }
}
