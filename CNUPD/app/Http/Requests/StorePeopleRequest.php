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
            'skin_color' => 'nullable',
            'gender' => 'nullable',
            'weight'=> 'nullable|numeric',
            'birth_date' => 'nullable|date|before_or_equal:today',
            'age'=> 'nullable|integer',
            'missing' => 'required',
            'missing_time_date' => 'nullable|date|before_or_equal:today',
            'time_date' => 'nullable|date|before_or_equal:today',
            'father_name' => 'nullable|string',
            'mother_name' => 'nullable|string',
            'height' => 'nullable|numeric',
            'other_features' => 'nullable|string',
            'circumstances'=> 'required|string',
            'motivations' => 'nullable|string',
            'city' => 'required',
            'state' =>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Campo nome é obrigatório',
            'circumstances.required' => 'Insira as circustâncias da pessoa desaparecida/não identificada',
            'name_organization' => 'Insira o nome do local/organização de registro',
            'state.required' => 'Insira um estado',
            'city.required' => 'Insira uma cidade',
            'birth_date.before_or_equal' => 'Data de nascimento inválida',
            'missing_time_date.required' => 'Insira a data de desaparecimento',
            'missing_time_date.before_or_equal' => 'Data de desaparecimento inválida',
            'time_date.before_or_equal' => 'Data inválida',
            'image.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
        ];
    }
}
