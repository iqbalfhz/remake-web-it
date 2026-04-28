<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMailingListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('mailing-list.create');
    }

    public function rules(): array
    {
        return [
            'department' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
        ];
    }
}
