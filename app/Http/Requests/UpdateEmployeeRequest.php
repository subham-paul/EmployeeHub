<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'], // Only allows letters and spaces
            'email' => [
                'required',
                'email',
                Rule::unique('employees')->ignore($this->employee->id),
            ],
            'phone' => ['required', 'numeric', 'digits:10', 'regex:/^[6-9]\d{9}$/'], // 10 digits, starts with 6-9
            'department_id' => 'required',
            'designation' => 'required',
            'salary' => 'required|numeric',
            'joining_date' => 'required|date',
            'status' => 'required',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
            'name.regex' => 'The name field must only contain letters and spaces.',
            'phone.regex' => 'The phone number must be a 10-digit Indian mobile number (starting with 6, 7, 8, or 9).',
            'phone.digits' => 'The phone number must be exactly 10 digits.',
        ];
    }
}
