<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUsersRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.$this->route('user'),
            'phone' => 'required|unique:users,phone,'.$this->route('user'),
            'role' => ['required', Rule::in(User::$roles)],
            "password" => 'nullable|string|min:8|confirmed'
        ];
    }
}
