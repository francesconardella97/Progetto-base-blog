<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:5',
            'category' => 'required',
            'body' => 'required',
        ];
    }

    public function messages(): array
        {
        return [
            'title.required' => 'Il campo Titolo non può essere vuoto',
            'title.max' => 'Il campo non può esssere più lungo di :max caratteri',
            'category.required' => 'Il campo Categoria non può essere vuoto',
            'body.required' => 'Il campo Corpo non può essere vuoto'
        ];
    }
}
