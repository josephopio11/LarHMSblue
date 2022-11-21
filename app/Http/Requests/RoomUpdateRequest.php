<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomUpdateRequest extends FormRequest
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
            'room_no' => ['string', 'max:255'],
            'name' => ['string', 'max:255'],
            'price' => ['required', 'integer'],
            'capacity' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'image' => ['string', 'max:255'],
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'room_type_id' => ['required', 'integer', 'exists:room_types,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
