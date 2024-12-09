<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class AdvancePaymentNoteRequest extends FormRequest {

    public function authorize(): bool {

        return auth()->check();
    }

    public function rules(): array {

        return [
            'ap_date' => 'required|date',
            'supplier_id' => 'required|integer|exists:supplier,id',
            'value' => 'required|numeric|min:0',
            'remark' => 'nullable|string|max:100',
            'cancel' => 'required|boolean',
            'cancel_on' => 'nullable|date|after_or_equal:ap_date',
            'cancel_remark' => 'nullable|string|max:100',
        ];
    }
}
