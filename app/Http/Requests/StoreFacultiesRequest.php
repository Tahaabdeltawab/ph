<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacultiesRequest extends FormRequest
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
        $id = $this->faculty ?? null;
        return [
            'university_id' => 'nullable|exists:universities,id',
            'code' => 'required|max:200|unique:faculties,code,'.$id,
            'title' => 'required|max:200'
        ];
    }
}
