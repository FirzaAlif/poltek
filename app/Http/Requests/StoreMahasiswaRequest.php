<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMahasiswaRequest extends FormRequest
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
            'nim' => 'required|string|max:10|unique:mahasiswas,nim',
            'name' => 'required|string|max:255',
            'departement_id' => 'required|exists:departements,id',
            'phone' => 'required|numeric|digits_between:10,13',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email|max:255|unique:mahasiswas,email',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nim.required' => 'NIM wajib diisi.',
            'nim.max' => 'NIM maksimal 10 karakter.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'name.required' => 'Nama wajib diisi.',
            'departement_id.required' => 'Jurusan wajib dipilih.',
            'departement_id.exists' => 'Jurusan yang dipilih tidak valid.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.numeric' => 'Nomor telepon harus berupa angka.',
            'phone.digits_between' => 'Nomor telepon harus terdiri dari 10 hingga 13 angka.',
            'photo.image' => 'Foto harus berupa gambar.',
            'photo.mimes' => 'Format foto harus jpeg, png, jpg, atau gif.',
            'photo.max' => 'Ukuran foto maksimal adalah 2MB.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
        ];
    }
}
