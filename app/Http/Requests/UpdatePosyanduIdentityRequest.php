<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePosyanduIdentityRequest extends FormRequest
{
    protected $errorBag = 'posyanduIdentity';

    public function authorize(): bool
    {
        return (bool) $this->user()?->posyandu_id;
    }

    public function rules(): array
    {
        return [
            'nama_posyandu' => ['required', 'string', 'max:150'],
            'kecamatan' => ['required', 'string', 'max:100'],
            'kelurahan' => ['required', 'string', 'max:100'],
        ];
    }
}
