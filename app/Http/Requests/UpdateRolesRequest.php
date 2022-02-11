<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRolesRequest extends FormRequest
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
        $id = $this->role ?? null;
        return [
            'name' => 'required|max:200|unique:roles,name,'.$id,
            'display_name' => 'nullable|max:200',
            'description' => 'nullable|max:200',
        ];
    }
}
