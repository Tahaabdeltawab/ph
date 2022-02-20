<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMcqResultsRequest extends FormRequest
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
            'data' => 'required',
            'mode' => 'required|in:MCQ,Complete',
            'score' => 'required|numeric',
            'chapter_id' => 'nullable|exists:chapters,id',
            'topic_id' => 'required|exists:topics,id'
        ];
    }
}
