<?php

namespace App\Http\Requests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return [
                'username' => ['required','regex:/^[a-zA-Z\s]+$/'],
                'useremail' => ['required', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/',Rule::unique('users', 'email')],
                'password' => 'required|confirmed|min:6',
            ];
        } elseif ($this->isMethod('put')) {
            return [
                'username' => ['required','regex:/^[a-zA-Z\s]+$/'],
                'useremail' => ['required', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/', Rule::unique('users', 'email')->ignore($this->route('id'))],
                'password' => 'nullable|min:6',
            ];
        }
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'success' => false,
                    'message' => 'Validation errors',
                    'data' => $validator->errors(),
                ],
                422,
            ),
        );
    }

    public function messages(): array
    {
        return [
            'username.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'useremail.required' => 'The email field is required.',
            'email.regex' => 'The email must be a valid email address.',
            'useremail.regex' => 'The email must be a valid email address.',
            'username.regex' => 'The name field must be string.',
            
        ];
    }
}
