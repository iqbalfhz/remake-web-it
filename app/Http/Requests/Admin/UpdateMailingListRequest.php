<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMailingListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('mailing-list.edit');
    }

    public function rules(): array
    {
        return [
            'department' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
        ];
    }
}
