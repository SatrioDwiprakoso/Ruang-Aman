<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengaduanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|integer|exists:categories,id_category',
            'title' => 'required|string|min:10|max:200',
            'address' => 'required|string|min:10|max:500',
            'chronology' => 'required|string|min:30|max:5000',
            'is_anonymous' => 'nullable|boolean',
            'evidences.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mp3,pdf|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori pengaduan wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            'title.required' => 'Judul pengaduan wajib diisi.',
            'title.min' => 'Judul pengaduan minimal 10 karakter.',
            'title.max' => 'Judul pengaduan maksimal 200 karakter.',
            'address.required' => 'Alamat/lokasi kejadian wajib diisi.',
            'address.min' => 'Alamat/lokasi minimal 10 karakter.',
            'address.max' => 'Alamat/lokasi maksimal 500 karakter.',
            'chronology.required' => 'Kronologi kejadian wajib diisi.',
            'chronology.min' => 'Kronologi kejadian minimal 30 karakter. Jelaskan secara singkat apa yang terjadi.',
            'chronology.max' => 'Kronologi kejadian maksimal 5000 karakter.',
            'evidences.*.file' => 'File bukti harus berupa file yang valid.',
            'evidences.*.mimes' => 'Format file yang diizinkan: JPG, PNG, GIF, MP4, MP3, PDF.',
            'evidences.*.max' => 'Ukuran setiap file maksimal 10MB.',
        ];
    }
}