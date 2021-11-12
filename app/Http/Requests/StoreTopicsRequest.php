<?php
namespace App\Http\Requests;

use App\Models\Topic;
use Illuminate\Foundation\Http\FormRequest;

class StoreTopicsRequest extends FormRequest
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
        if($this->topic){
            $id = $this->topic;
            $topic = Topic::find($id);
        }
        return [
            'title' => "required|unique:topics,title,$id,year_id,$topic->year_id",
            'year_id' => 'nullable|exists:years,id',
        ];
    }
}
