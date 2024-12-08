<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class LeafReceiveNoteRequest extends FormRequest {

    public function authorize(): bool {

        return auth()->check();
    }

    public function rules(): array {

        return [
            'lr_date' => 'required|date',
            'supplier_id' => 'required|integer|exists:supplier,id',
            'lc_id' => 'required|integer|exists:leaf_category,id',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'lrn_value' => 'required|numeric|min:0',
            'paid_value' => 'nullable|numeric|min:0',
            'paid_on' => 'nullable|date',
            'remark' => 'nullable|string|max:100',
            'cancel' => 'required|boolean',
            'cancel_on' => 'nullable|date',
            'cancel_remark' => 'nullable|string|max:100',
        ];
    }
}
