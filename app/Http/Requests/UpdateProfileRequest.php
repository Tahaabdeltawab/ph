<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
        return [
            'username' => 'required',
            'email' => 'required|email|unique:users,email,'.auth()->id(),
            'phone' => 'required|unique:users,phone,'.auth()->id(),
            'university_id' => 'required|integer|exists:universities,id',
            'faculty_id' => 'required|integer|exists:faculties,id',
            'year_id' => 'required|integer|exists:years,id',
        ];
    }
}
