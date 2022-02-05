<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDefinitionsRequest extends FormRequest
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
            'title' => 'required|string',
            'terms' => 'required|array',
            'tags' => 'nullable|array',
            'chapter_id' => 'required|exists:chapters,id',
            'topic_id' => 'required|exists:topics,id',
            'reversible' => 'nullable|boolean',
            'automcquable' => 'nullable|boolean',
            'explanation' => 'nullable',
        ];
    }
}
