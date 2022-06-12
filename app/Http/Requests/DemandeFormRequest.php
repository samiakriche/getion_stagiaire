<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules [
            
            'titre' => [
                'nullable',
                'string',
            ],
              'decription' => [
                'nullable',
                'string',
            ],
            'date_debut' => [
                'nullable',
                'string',
            ],
            'date_fin' => [
                'nullable',
                'string',
            ],
        ];
        return $rules;
    }
}
