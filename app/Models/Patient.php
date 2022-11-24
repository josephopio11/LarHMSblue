<?php

namespace App\Models;

use App\Http\Joseph\Traits\updatableAndCreatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    use updatableAndCreatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registration_no',
        'registration_date',
        'referral',
        'referred_by',
        'patient_type',
        'title',
        'name',
        'dob',
        'gender',
        'marital_status',
        'blood_group',
        'email',
        'phone',
        'religion',
        'occupation',
        'country',
        'home_phone',
        'home_address',
        'fathers_name',
        'fathers_phone',
        'fathers_address',
        'mothers_name',
        'mothers_phone',
        'mothers_address',
        'same_as_patient',
        'next_of_kin_phone',
        'next_of_kin_email',
        'next_of_kin_address',
        'payment_method',
        'symptoms',
        'image',
        'created_by_id',
        'updated_by_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'registration_date' => 'date',
        'dob' => 'date',
        'created_by_id' => 'integer',
        'updated_by_id' => 'integer',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }
}
