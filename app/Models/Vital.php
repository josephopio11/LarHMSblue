<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vital extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'systolic_b_p', 'diastolic_b_p', 'temperature', 'weight', 'height',
        'pulse', 'respiratory_rate', 'heart_rate', 'urine_output', 'blood_sugar_r',
        'blood_sugar_f', 'spo_2', 'avpu', 'trauma', 'mobility', 'oxygen_supplement', 'comment', 'status',
        'patient_id', 'patient_visit_id', 'user_id', 'created_by_id', 'updated_by_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'patient_id' => 'integer',
        'patient_visit_id' => 'integer',
        'user_id' => 'integer',
        'created_by_id' => 'integer',
        'updated_by_id' => 'integer',
    ];

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
