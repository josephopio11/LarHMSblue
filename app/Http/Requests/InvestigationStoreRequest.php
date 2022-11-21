<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestigationStoreRequest extends FormRequest
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
            'stat' => ['string', 'max:255'],
            'ot_required' => ['string', 'max:255'],
            'result' => ['string', 'max:255'],
            'status' => ['required', 'string'],
            'test_type_id' => ['required', 'integer', 'exists:test_types,id'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'patient_visit_id' => ['required', 'integer', 'exists:patient_visits,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
