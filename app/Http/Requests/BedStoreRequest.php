<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BedStoreRequest extends FormRequest
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
            'bed_no' => ['string', 'max:255'],
            'name' => ['string', 'max:255'],
            'price' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'image' => ['string', 'max:255'],
            'room_id' => ['required', 'integer', 'exists:rooms,id'],
            'bed_type_id' => ['required', 'integer', 'exists:bed_types,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
