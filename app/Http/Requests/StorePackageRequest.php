<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tracking_code' => 'required|string|unique:packages,tracking_code',
            'commune_id' => 'required|integer|exists:communes,id',
            'delivery_type_id' => 'required|integer|exists:delivery_types,id',
            'status_id' => 'required|integer|exists:package_statuses,id',
            'store_id' => 'required|integer|exists:stores,id',
            'address' => 'required|string|max:255',
            'can_be_opened' => 'boolean',
            'name' => 'nullable|string|max:255',
            'client_first_name' => 'required|string|max:255',
            'client_last_name' => 'required|string|max:255',
            'client_phone' => 'required|string|max:20',
            'client_phone2' => 'nullable|string|max:20',
            'cod_to_pay' => 'required|numeric|min:0',
            'commission' => 'required|numeric|min:0',
            'status_updated_at' => 'nullable|date',
            'delivered_at' => 'nullable|date',
            'delivery_price' => 'required|numeric|min:0',
            'extra_weight_price' => 'required|integer|min:0',
            'free_delivery' => 'required|boolean',
            'packaging_price' => 'required|integer|min:0',
            'partner_cod_price' => 'required|numeric|min:0',
            'partner_delivery_price' => 'required|integer|min:0',
            'partner_return' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'price_to_pay' => 'required|numeric|min:0',
            'return_price' => 'required|integer|min:0',
            'total_price' => 'required|numeric|min:0',
            'weight' => 'required|integer|min:1',
        ];
    }
}
