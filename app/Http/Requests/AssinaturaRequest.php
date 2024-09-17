<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssinaturaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'plano_preco_id'       => 'required',
            'valor_contrato'       => 'required',
            'valor_recorrente'     => 'required'
        ];
    }
}
