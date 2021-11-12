<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreYearsRequest extends FormRequest
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
        $id = $this->year ?? null;
        return [
            'faculty_id' => 'nullable|exists:faculties,id',
            'code' => 'required|max:200|unique:yaers,code,'.$id,
            'title' => 'required|max:200'
        ];
    }
}
