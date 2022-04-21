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
            // both
            "id" => $this->id,
            "title" => $this->title,
            "flashable" => $this->flashable,
            "reversible" => $this->reversible,
            "mcquable" => $this->mcquable,
            "custommcquable" => $this->custommcquable,
            "automcquable" => $this->automcquable,
            "completable" => $this->completable,
            'terms_ids' => $this->terms->pluck('id'),
            'terms' => $this->terms->pluck('title'),
            "explanation" => $this->explanation,
            // user
            'mcq_terms' => $mcq_terms,
            'term_id' => $this->term->id, // used to evaluate (mcq option & complete) is correct or not (in case the definition has only one term)
            'term' => $this->term->title, // used to be saved in mcqResults (in case the definition has only one term). and to be shown in flashcard when custommcquable and flashable
            "fav" => $this->hasBeenFavoritedBy(auth()->user()),
            "level" => $this->user_level ? $this->user_level->level : 'unanswered',
            // admin
            'topic_id' => $this->topic_id,
            'topic' => $this->topic->title,
            'chapter_id' => $this->chapter_id,
            'chapter' => $this->chapter->title,
            'tags' => collect($this->tags)->pluck('name', 'id'),
        ];
        return $return;
    }
}