<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BloodStockDetailStoreRequest extends FormRequest
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
            'total' => ['required', 'integer'],
            'balance' => ['required', 'integer'],
            'blood_stock_id' => ['required', 'integer', 'exists:blood_stocks,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
