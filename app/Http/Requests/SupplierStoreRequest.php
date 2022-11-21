<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierStoreRequest extends FormRequest
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
            'name' => ['string', 'max:255'],
            'code' => ['string', 'max:255'],
            'email' => ['email', 'max:255'],
            'phone' => ['string', 'max:255'],
            'address' => ['string'],
            'company' => ['string', 'max:255'],
            'product' => ['string', 'max:255'],
            'description' => ['string'],
            'status' => ['required', 'string'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
