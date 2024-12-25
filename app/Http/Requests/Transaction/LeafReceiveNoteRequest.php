<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class LeafReceiveNoteRequest extends FormRequest {

    public function authorize(): bool {

        return auth()->check();
    }

    public function rules(): array {

        return [
            'lrnDate' => 'required|date',
            'supplierId' => 'required|integer|exists:supplier,id',
            'leafCategoryId' => 'required|integer|exists:leaf_category,id',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            'remark' => 'nullable|string|max:100',
        ];
    }
}
