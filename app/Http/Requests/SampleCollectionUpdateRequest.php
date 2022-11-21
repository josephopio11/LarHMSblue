<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SampleCollectionUpdateRequest extends FormRequest
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
            'sample_code' => ['string', 'max:255'],
            'collect_date' => [''],
            'receive_date' => [''],
            'dispatch_date' => [''],
            'cancel_dispatch_date' => [''],
            'status' => ['required', 'string'],
            'investigation_id' => ['required', 'integer', 'exists:investigations,id'],
            'laboratory_id' => ['required', 'integer', 'exists:laboratories,id'],
            'approved_by_id' => ['required', 'integer', 'exists:approved_bies,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
