<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperationUpdateRequest extends FormRequest
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
            'operation_date' => ['date'],
            'operation_time' => [''],
            'amount' => ['required', 'integer'],
            'description' => ['string'],
            'status' => ['required', 'string'],
            'operation_type_id' => ['required', 'integer', 'exists:operation_types,id'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
