<?php

namespace App\Http\Requests\Api\Task;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaskStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'due_date' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'notes.*.subject'=>'required',
            'notes.*.note'=>'required',
            'notes.*.attachment.*.file'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
            'subject' => 'The subject field is required.',
            'description' => 'The description field is required.',
            'start_date' => 'The start_date field is required.',
            'due_date' => 'The due_date field is required.',
            'status' => 'The status field is required.',
            'priority' => 'The priority field is required.',
            'notes'=>'array',
            'notes.*.subject'=>'The note\'s subject field is required.',
            'notes.*.note'=>'The note\'s note field is required.',
            'notes.*.attachment.*.file'=>'The note\'s attachment field is required.',
        ];
    }
}
