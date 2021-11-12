<?php

namespace App\Http\Livewire\Question;

use Livewire\Component;

use App\Models\Topic;
use App\Models\Chapter;
use App\Models\Question;

class Save extends Component
{

    public $selected_topic_id;
    public $selected_topic;
    public $topics;
    public $question; // in question edit page

    public function mount()
    {
        $this->topics = Topic::get();
        if(isset($this->question->topic))
        {
            $this->selected_topic_id = $this->question->topic->id;
            $this->setNewSelectedTopic();
        }
    }

    public function setNewSelectedTopic()
    {
        $this->selected_topic = Topic::with('chapters')->find($this->selected_topic_id);
    }

    public function render()
    {
        return view('livewire.question.save');
    }
}
