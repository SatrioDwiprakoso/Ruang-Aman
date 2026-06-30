@extends('layouts.admin')

@section('page-title', $category ? 'Edit Kategori' : 'Tambah Kategori')

@section('content')
    <div class="max-w-lg">
        <a href="{{ route('admin.kategori') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-midnight-700 mb-6 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Kategori
        </a>

        <div class="card p-6">
            <form method="POST"
                action="{{ $category ? route('admin.kategori.update', $category->id_category) : route('admin.kategori.store') }}"
                class="space-y-5">
                @csrf
                @if($category) @method('PUT') @endif

                <div>
                    <label class="label-field">Nama Kategori</label>
                    <input type="text" name="category_name"
                        value="{{ old('category_name', $category->category_name ?? '') }}" class="input-field"
                        placeholder="Contoh: Kekerasan Fisik" required>
                </div>

                <div>
                    <label class="label-field">Tingkat Urgensi</label>
                    <div class="space-y-2">
                        @foreach(['Rendah', 'Sedang', 'Berat'] as $level)
                            @php $wc = weightColor($level); @endphp
                            <label
                                class="flex items-center gap-3 p-3 rounded-xl border-2 cursor-pointer transition-all duration-200 hover:border-justice/50"
                                :class="document.querySelector('input[value={{ $level }}]:checked') ? 'border-justice bg-justice/5' : 'border-slate-100'">
                                <input type="radio" name="weight_level" value="{{ $level }}" {{ (old('weight_level', $category->weight_level ?? '') === $level) ? 'checked' : '' }}
                                    class="w-4 h-4 text-justice focus:ring-justice border-slate-300">
                                <span style="{{ weightStyle($level) }}">{{ $level }}</span> </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn-primary w-full">
                    {{ $category ? 'Perbarui Kategori' : 'Simpan Kategori' }}
                </button>
            </form>
        </div>
    </div>
@endsection