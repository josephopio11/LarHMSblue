<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseStoreRequest extends FormRequest
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
            'type' => ['required', 'string'],
            'medicine_generic_name' => ['string', 'max:255'],
            'medicine_unit' => ['string', 'max:255'],
            'medicine_strength' => ['string', 'max:255'],
            'medicine_shelf_life' => ['string', 'max:255'],
            'quantity' => ['required', 'integer'],
            'quantity_type' => ['string', 'max:255'],
            'price' => ['required', 'integer'],
            'expiry_date' => ['date'],
            'note' => ['string'],
            'image' => ['string', 'max:255'],
            'status' => ['required', 'string'],
            'medicine_type_id' => ['required', 'integer', 'exists:medicine_types,id'],
            'medicine_category_id' => ['required', 'integer', 'exists:medicine_categories,id'],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
