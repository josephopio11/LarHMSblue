<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BloodIssueStoreRequest extends FormRequest
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
            'unit' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'blood_request_id' => ['required', 'integer', 'exists:blood_requests,id'],
            'blood_stock_detail_id' => ['required', 'integer', 'exists:blood_stock_details,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
