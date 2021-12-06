<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePasswordRequest extends FormRequest
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
        $old_password_required = auth()->user()->password ? 'required' : 'nullable';
        return [
            "old_password" => [$old_password_required, "string"],
            "new_password" => ["required", "string", "min:8", "confirmed"],
        ];
    }
}
