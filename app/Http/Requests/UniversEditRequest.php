<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniversEditRequest extends FormRequest
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
            'nom' => 'required|min:3',
            'description' => 'required|min:3',
            'couleur_principal' => 'required|min:6',
            'couleur_secondaire' => 'required|min:6',
        ];
    }
}
