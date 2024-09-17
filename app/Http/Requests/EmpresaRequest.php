<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
    public function rules()    {
        return [
            'razao_social'  => 'required|min:5',
            'email'         => 'required|unique:empresas',
            'logradouro'    => 'required',
            'numero'        => 'required',
            'bairro'        => 'required',
            'cep'           => 'required',
            'cidade'        => 'required',
            'uf'            => 'required',
            'fone'      => 'telefone_com_ddd',
        ];
    }
    
    
    public function messages() {
        
        return [
            'fone.telefone_com_ddd' => 'Telefone não válido, use o formato (99)9999-9999 !'
        ];
    }
}
