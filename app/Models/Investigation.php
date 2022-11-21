<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stat',
        'ot_required',
        'result',
        'status',
        'test_type_id',
        'patient_id',
        'patient_visit_id',
        'user_id',
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
        'test_type_id' => 'integer',
        'patient_id' => 'integer',
        'patient_visit_id' => 'integer',
        'user_id' => 'integer',
        'created_by_id' => 'integer',
        'updated_by_id' => 'integer',
    ];

    public function testType()
    {
        return $this->belongsTo(TestType::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function patientVisit()
    {
        return $this->belongsTo(PatientVisit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }
}
