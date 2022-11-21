<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalSettingUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'website' => ['string', 'max:255'],
            'phone' => ['string', 'max:255'],
            'fax' => ['string', 'max:255'],
            'country' => ['string', 'max:255'],
            'address' => ['string', 'max:255'],
            'extablished' => ['date'],
            'email' => ['email', 'max:255'],
            'logo' => ['string', 'max:255'],
            'favicon' => ['string', 'max:255'],
            'size' => ['string', 'max:255'],
            'type' => ['string', 'max:255'],
            'facebook' => ['string', 'max:255'],
            'twitter' => ['string', 'max:255'],
            'whatsapp' => ['string', 'max:255'],
            'instagram' => ['string', 'max:255'],
            'driver' => ['string', 'max:255'],
            'encryption' => ['string', 'max:255'],
            'host' => ['string', 'max:255'],
            'port' => ['string', 'max:255'],
            'username' => ['string', 'max:255'],
            'email_from' => ['email', 'max:255'],
            'email_from_name' => ['email', 'max:255'],
            'invoice_prefix' => ['string', 'max:255'],
            'invoice_logo' => ['string', 'max:255'],
            'user_prefix' => ['string', 'max:255'],
            'patient_prefix' => ['string', 'max:255'],
            'invoice_number_mode' => ['string', 'max:255'],
            'invoice_last_number' => ['string', 'max:255'],
            'taxes' => ['string', 'max:255'],
            'discount' => ['string', 'max:255'],
        ];
    }
}
