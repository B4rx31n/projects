<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class datarequest extends FormRequest
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
            'nip'=>'required',
            'nama'=>'required',
            'jenis_kelamin'=>'required',
            'tll'=>'required',
            'tamatan'=>'required',
            'alamat'=>'required',
        ];
    }
    public function messages(): array
    {
        return[
            'nip.required' => 'NIP wajib diisi',
            'nama.required' => 'Nama wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
        ];
    }
}
