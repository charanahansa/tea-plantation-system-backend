<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest {

    public function authorize(): bool {

        return auth()->check();
    }

    public function rules(): array {

        return [
            'supplier_name' => 'required|string|max:100',
            'contact_no' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'address' => 'required|string|max:150',
            'active' => 'required|boolean'
        ];
    }
}
