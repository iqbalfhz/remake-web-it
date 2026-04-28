<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffEmailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('staff-email.create');
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'pt' => ['required', 'string', 'max:255'],
            'departemen' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
            'email_workspace' => ['nullable', 'email', 'max:255'],
        ];
    }
}
