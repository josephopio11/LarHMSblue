<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'registration_no' => ['string', 'max:255'],
            'registration_date' => ['date'],
            'referral' => ['required', 'in:Yes,No'],
            'referred_by' => ['string', 'max:255'],
            'patient_type' => ['in:Inpatient,Outpatient'],
            'title' => ['in:Mr,Mrs,Miss,Ms,Dr,Prof,Rev'],
            'name' => ['required', 'string', 'max:255'],
            'dob' => ['date'],
            'gender' => ['required', 'in:M,F'],
            'marital_status' => ['in:Single,Married,Divorced,'],
            'blood_group' => ['in:A+,A-,B+,B-,AB+,AB-,O+,O-'],
            'email' => ['email', 'max:255'],
            'phone' => ['string', 'max:255'],
            'religion' => ['string', 'max:255'],
            'occupation' => ['string', 'max:255'],
            'country' => ['string', 'max:255'],
            'home_phone' => ['string', 'max:255'],
            'home_address' => ['string'],
            'fathers_name' => ['string', 'max:255'],
            'fathers_phone' => ['string', 'max:255'],
            'fathers_address' => ['string'],
            'mothers_name' => ['string', 'max:255'],
            'mothers_phone' => ['string', 'max:255'],
            'mothers_address' => ['string'],
            'same_as_patient' => ['required', 'string'],
            'next_of_kin_phone' => ['string', 'max:255'],
            'next_of_kin_email' => ['string', 'max:255'],
            'next_of_kin_address' => ['string'],
            'payment_method' => ['in:Cash,Card,Cheque'],
            'symptoms' => ['string'],
            'image' => ['string', 'max:255'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
