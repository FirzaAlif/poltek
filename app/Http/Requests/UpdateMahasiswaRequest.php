<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMahasiswaRequest extends FormRequest
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
            'nim' => [
                'required',
                'string',
                'max:20',
                Rule::unique('mahasiswas', 'nim')->ignore($this->mahasiswa->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'departement_id' => ['required', Rule::exists('departements', 'id')],
            'phone' => ['required', 'digits_between:10,15'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('mahasiswas', 'email')->ignore($this->mahasiswa->id),
            ],
        ];
    }
}
