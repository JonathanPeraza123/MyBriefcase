<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Contact extends FormRequest
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
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'min:5'],
            'body' => ['required', 'min:10']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '❗El nombre es requerido.',
            'name.min' => '❗El número minimo de caracteres es de 3.',
            'email.required' => '❗El email es requerido.',
            'email.email' => '❗Tiene que ser un email valido',
            'subject.required' => '❗El asunto es requerido',
            'subject.min' => '❗El número minimo de caracteres es 5',
            'body.required' => '❗El mensaje es requerido',
            'body.min' => '❗El número minimo de caracteres es de 10',
        ];
    }
}
