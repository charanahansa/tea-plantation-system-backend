<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class AdvancePaymentNoteRequest extends FormRequest {

    public function authorize(): bool {

        return auth()->check();
    }

    public function rules(): array {

        return [
            'apnDate' => 'required|date',
            'supplierId' => 'required|integer|exists:supplier,id',
            'advanceAmount' => 'required|numeric|min:0',
            'remark' => 'nullable|string|max:100'
        ];
    }
}
