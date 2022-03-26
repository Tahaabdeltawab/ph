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
        $type = $this->route('user') ? 'update' : 'create';
        $passwordRequired = $type == 'create' ? 'required' : 'nullable';
        return [
            'username' => 'required',
            'email' => 'nullable|email|unique:users,email,'.$this->route('user'),
            'status' => ['required', 'boolean'],
            "password" => "$passwordRequired|string|min:8",
        ];
    }
}
