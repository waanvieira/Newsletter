<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewLetterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        switch ($this->getMethod()) {
            case 'POST':
                return [
                    'name' => 'required',
                    'email' => 'required'
                ];
            case 'PUT':
                return [
                    'name' => 'required',
                ];
        }
    }
}
