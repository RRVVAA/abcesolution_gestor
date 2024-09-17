<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
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
            'razao_social'  => 'required|min:5',
            'cpf_cnpj'      => 'required',
            'logradouro'    => 'required',
            'numero'        => 'required',
            'bairro'        => 'required',
            'cep'           => 'required',
            'cidade'        => 'required',
            'uf'            => 'required'
        ];
    }
}
