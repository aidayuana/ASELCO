<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Ubah menjadi true untuk mengizinkan semua pengguna melakukan request ini
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'school_id' => 'required|exists:schools,id', // Pastikan 'school_id' ada di request dan valid
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ];
    }
}
