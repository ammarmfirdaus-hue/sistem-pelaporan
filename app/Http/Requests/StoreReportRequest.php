<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReportRequest extends FormRequest
{
    public function rules(): array
    {
        $needsPosyandu = ! $this->user()?->posyandu_id;
        $phone = ['required', 'regex:/^(?:\+62|62|0)8[1-9][0-9]{6,11}$/'];

        return [
            'nama_posyandu' => [Rule::requiredIf($needsPosyandu), 'nullable', 'string', 'max:150'],
            'kecamatan' => [Rule::requiredIf($needsPosyandu), 'nullable', 'string', 'max:100'],
            'kelurahan' => [Rule::requiredIf($needsPosyandu), 'nullable', 'string', 'max:100'],
            'no_hp_petugas' => $phone,
            'ayah_nama' => ['required', 'string', 'max:100'],
            'ayah_alamat' => ['required', 'string'],
            'ayah_no_hp' => $phone,
            'ibu_nama' => ['required', 'string', 'max:100'],
            'ibu_alamat' => ['required', 'string'],
            'ibu_no_hp' => $phone,
            'child_nama' => ['required', 'string', 'max:100'],
            'child_jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'child_tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'berat_badan' => ['required', 'numeric', 'min:0', 'max:80'],
            'tinggi_badan' => ['required', 'numeric', 'min:0', 'max:150'],
            'lingkar_kepala' => ['required', 'numeric', 'min:0', 'max:80'],
            'imunisasi' => ['nullable', 'string', 'max:100'],
            'beri_vitamin_a' => ['sometimes', 'boolean'],
            'beri_obat_cacing' => ['sometimes', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'beri_vitamin_a' => $this->boolean('beri_vitamin_a'),
            'beri_obat_cacing' => $this->boolean('beri_obat_cacing'),
        ]);
    }

    public function messages(): array
    {
        return [
            '*.regex' => 'Format nomor HP harus diawali 08, 628, atau +628.',
        ];
    }
}
