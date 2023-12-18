<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TournamentRequest extends FormRequest
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
        return [
            'gen' => 'required|string',
            'cant' => [
                'required',
                'numeric',
                'min:2',
                'max:100',
            ],
        ];
    }
}
