<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $fillable = [
        'deafult_currency',
        'deafult_country_code',
        'language',
        'smtp_mail',
        'smtp_username',
        'smtp_password',
        'smtp_host',
        'smtp_port',
        'smtp_encryption'
    ];
}
