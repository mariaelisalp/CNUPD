<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeopleRequest extends FormRequest
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
            'name'=> 'required|string|max:255',
            'eye_color' => 'nullable|string',
            'skin_color' => 'nullable|string',
            'gender' => 'nullable',
            'weight'=> 'nullable|numeric',
            'birth_date' => 'nullable|date',
            'age'=> 'nullable|integer',
            'missing' => 'required',
            'missing_time_date' => 'nullable',
            'time_date' => 'nullable',
            'father_name' => 'nullable|string',
            'mother_name' => 'nullable|string',
            'height' => 'nullable|numeric',
            'other_features' => 'nullable|string',
            'circumstances'=> 'required|string',
            'motivations' => 'nullable|string',
            'city' => 'required | string | max:255',
            'state' =>'required | string | max:255',
            'name_organization' => 'required|string',
            'email' => 'required|email',
            'number' => 'required|numeric|digits:11',
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Campo nome é obrigatório',
            'circumstances.required' => 'Insira as circustâncias da pessoa desaparecida/não identificada',
            'name_organization' => 'Insira o nome do local/organização de registro',
            'city.required' => 'Insira uma cidade',
            'state.required' => 'Insira um estado',
            'email.required' => 'Insira um email válido',
            'number' => 'Insira um número de telefone válido',
        ];
    }
}
