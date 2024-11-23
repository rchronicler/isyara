<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // true if user is authenticated and role is 'volunteer'
        return auth()->check() && auth()->user()->role === 'volunteer';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'video' => ['file', 'mimes:mp4,mov,avi', 'max:40960'], // 40MB
            'category' => ['required'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'title.max' => 'Title must not exceed 255 characters',
            'description.string' => 'Description must be a string',
            'video.file' => 'Video must be a file',
            'video.mimes' => 'Video must be a file of type: mp4, mov, avi',
            'video.max' => 'Video must not exceed 40MB',
            'category.required' => 'Category is required',
        ];
    }
}
