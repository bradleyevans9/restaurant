<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Message extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $dates = [
        'mailgun_timestamp', 'disabled_at',
    ];  //

    protected $fillable = ['mailgun_id', 'mailgun_timestamp', 'storage_url', 'from', 'to', 'subject', 'from_id', 'to_id', 'is_processed'];
}