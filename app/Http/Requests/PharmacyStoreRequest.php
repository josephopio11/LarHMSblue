<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyStoreRequest extends FormRequest
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
            'code' => ['string', 'max:255'],
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255'],
            'phone' => ['string', 'max:255'],
            'address' => ['string'],
            'status' => ['required', 'string'],
            'branch_id' => ['required', 'integer', 'exists:branches,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
