<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DefinitionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $terms = $this->terms->prepend($this->term)->map(function($term, $key){
            return ['label' => $term->title, 'value' => $term->id, 'color' => 'amber'];
        })->shuffle();
        
        $return = [
            "id" => $this->id,
            "fav" => $this->hasBeenFavoritedBy(auth()->user()),
            "level" => @$this->user_level->level,
            "title" => $this->title,
            'topic_id' => $this->topic_id,
            'topic' => $this->topic->title,
            'chapter_id' => $this->chapter_id,
            'chapter' => $this->chapter->title,
            'term_id' => $this->term->id,
            'term' => $this->term->title,
            'terms' => $terms,
        ];
        return $return;
    }
}