<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NurseStoreRequest extends FormRequest
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
            'about_nurse' => ['string', 'max:255'],
            'experience' => ['string', 'max:255'],
            'status' => ['required', 'string'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'specialist_id' => ['required', 'integer', 'exists:specialists,id'],
            'created_by_id' => ['required', 'integer', 'exists:created_bies,id'],
            'updated_by_id' => ['required', 'integer', 'exists:updated_bies,id'],
        ];
    }
}
