<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'website',
        'phone',
        'fax',
        'country',
        'address',
        'extablished',
        'email',
        'logo',
        'favicon',
        'size',
        'type',
        'facebook',
        'twitter',
        'whatsapp',
        'instagram',
        'driver',
        'encryption',
        'host',
        'port',
        'username',
        'email_from',
        'email_from_name',
        'invoice_prefix',
        'invoice_logo',
        'user_prefix',
        'patient_prefix',
        'invoice_number_mode',
        'invoice_last_number',
        'taxes',
        'discount',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'extablished' => 'date',
    ];
}
