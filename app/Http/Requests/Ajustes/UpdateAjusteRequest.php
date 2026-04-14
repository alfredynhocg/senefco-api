<?php

namespace App\Http\Requests\Ajustes;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAjusteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'valor' => ['required', 'string'],
        ];
    }
}
