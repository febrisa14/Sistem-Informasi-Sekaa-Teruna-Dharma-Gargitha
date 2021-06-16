<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnggotaRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'name' => 'required',
            'no_telp' => 'required|numeric',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'tempekan' => 'required',
            'alamat' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'no_telp.numeric' => 'no. telp harus angka'
        ];
    }
}
