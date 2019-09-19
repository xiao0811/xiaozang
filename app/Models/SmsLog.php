<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    const TYPE_LOGIN = 1;
    // const TYPE_REGISTER = 2;

    protected $table = "sms_log";

    protected $fillable = [
        "phone", "content", "type",
    ];
}
