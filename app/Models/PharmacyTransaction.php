<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_amount',
        'payment_mode',
        'status',
        'patient_visit_id',
        'pharmacy_invoice_id',
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
        'patient_visit_id' => 'integer',
        'pharmacy_invoice_id' => 'integer',
        'created_by_id' => 'integer',
        'updated_by_id' => 'integer',
    ];

    public function patientVisit()
    {
        return $this->belongsTo(PatientVisit::class);
    }

    public function pharmacyInvoice()
    {
        return $this->belongsTo(PharmacyInvoice::class);
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