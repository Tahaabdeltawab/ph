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
        $mcq_terms = $this->custommcquable == 1
        ? $this->mcq_terms->map(fn($term, $key) => ['label' => $term->title, 'value' => $term->id, 'color' => 'amber'])->shuffle()
        : $this->mcq_terms->prepend($this->term)->map(fn($term, $key) => ['label' => $term->title, 'value' => $term->id, 'color' => 'amber'])->shuffle();
        
        $return = [
            "id" => $this->id,
            "fav" => $this->hasBeenFavoritedBy(auth()->user()),
            "level" => $this->user_level ? $this->user_level->level : 'unanswered',
            "title" => $this->title,
            "explanation" => $this->explanation,
            "custommcquable" => $this->custommcquable,
            "reversible" => $this->reversible,
            "automcquable" => $this->automcquable,
            'topic_id' => $this->topic_id,
            'topic' => $this->topic->title,
            'chapter_id' => $this->chapter_id,
            'chapter' => $this->chapter->title,
            'term_id' => $this->term->id, // used to evaluate mcq option is correct or not (in case the definition has only one term)
            'term' => $this->term->title, // used to be saved in mcqResults (in case the definition has only one term)
            'terms_ids' => $this->terms->pluck('id'),
            'terms' => $this->terms->pluck('title'),
            'mcq_terms' => $mcq_terms,
            'tags' => collect($this->tags)->pluck('name', 'id'),
        ];
        return $return;
    }
}