<?php

namespace App\Http\Livewire\Test;

use Livewire\Component;

use App\Http\Livewire\Question\Save;

use App\Models\Question;
use App\Models\QuestionsOption;

class Take extends Save
{

    public $questions;
    public $selected_chapter_id;

    public function mount()
    {
        parent::mount();
        // $this->questions = Question::inRandomOrder()->takeget();
        // foreach ($this->questions as $question) {
        //     $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        // }
    }

    public function setNewSelectedTopic()
    {
        parent::setNewSelectedTopic();

        $this->questions = Question::when(/* $this->selected_topic_id */1==1, function($q)
        {
            $q->where('topic_id', $this->selected_topic_id);
        }
        )->inRandomOrder()->get();

        foreach ($this->questions as $question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

    }

    public function setNewSelectedChapter()
    {
        $this->questions = Question::when(/* $this->selected_topic_id */ 1==1, function($q)
        {
            $q->where('topic_id', $this->selected_topic_id);
        }
        )->when($this->selected_chapter_id, function($q)
        {
            $q->where('chapter_id', $this->selected_chapter_id);
        }
        )->inRandomOrder()->get();

        foreach ($this->questions as $question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

    }


    public function render()
    {
        return view('livewire.test.take');
    }
}
