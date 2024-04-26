<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
                    'newsletter_id' => 'required',
                    'title' => 'required',
                    'message' => 'required',
                ];
            case 'PUT':
                return [
                    'newsletter_id' => 'required',
                    'title' => 'required',
                    'message' => 'required',
                ];
        }
    }
}
