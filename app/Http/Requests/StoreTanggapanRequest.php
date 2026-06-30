<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTanggapanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'response_text' => 'required|string|min:10|max:5000',
            'status' => 'required|in:Diproses,Selesai,Ditolak',
        ];
    }

    public function messages(): array
    {
        return [
            'response_text.required' => 'Tanggapan wajib diisi.',
            'response_text.min' => 'Tanggapan minimal 10 karakter.',
            'response_text.max' => 'Tanggapan maksimal 5000 karakter.',
            'status.required' => 'Status laporan wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ];
    }
}