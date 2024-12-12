<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class LeafCategoryRequest extends FormRequest {

    public function authorize(): bool {

        return auth()->check();
    }

    public function rules(): array {

        return [
            'lfName' => 'required|max:100',
            'active'  => 'required|in:0,1',
        ];
    }
}
