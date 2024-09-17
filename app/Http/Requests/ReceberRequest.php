<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceberRequest extends FormRequest
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
            'descricao'       => 'required|min:6',
            'empresa_id'      => 'required',
            'valor'           => 'required',
            'data_vencimento' => 'required',
            'data_lancamento' => 'required'
        ];
    }
}
