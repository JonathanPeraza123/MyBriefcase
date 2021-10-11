<?php

namespace App\Http\Requests;

use App\Rules\Slug;
use Illuminate\Foundation\Http\FormRequest;

class CreateProject extends FormRequest
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
            'name' => ['required', 'min:5'],
            'description' => ['required', 'min:10'],
            'slug' => ['required', new Slug, 'alpha_dash', 'unique:projects'],
            'repository' => ['required', 'url'],
            'link' => ['required', 'url'],
            'files' => ['required']
        ];
    }


    public function messages()
    {
        return [
            'name.required' => '❗El campo es requerido.',
            'name.min' => '❗El número minimo de caracteres es de 5.',
            'description.min' => '❗El número minimo de caracteres es 10.',
            'slug.required' => '❗El campo es requerido.',
            'slug.alpha_dash' => '❗Solo caracteres alpha númericos.',
            'slug.unique' => '❗Ya existe este slug en la base de datos.',
            'repository.required' => '❗El campo es requerido.',
            'repository.url' => '❗El campo debe tener una url valida.',
            'link.required' => '❗El campo es requerido.',
            'link.url' => '❗El campo debe tener una url valida.',
            'files.required' => '❗Es requerido imagenes del proyecto.'
        ];
    }
}
