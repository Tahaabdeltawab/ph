<div>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.quiz', ['number' => $questions ? count($questions):0])
        </div>

        <div style="margin:10px">
            <div class="row">
                <div class="col-xs-6 form-group">
                    <label for="topic_id" class="control-label">Topic*</label>

                    <select name="topic_id" id="topic_id" wire:model="selected_topic_id" wire:change="setNewSelectedTopic" class="form-control">
                        <option value="">please select..</option>
                        @foreach ($topics as $topic)
                            <option value="{{$topic->id}}">{{$topic->title}}</option>
                        @endforeach
                    </select>

                    <p class="help-block"></p>
                    @if($errors->has('topic_id'))
                        <p class="help-block">
                            {{ $errors->first('topic_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group">
                    <label for="chapter_id" class="control-label">Chapter*</label>

                    <select name="chapter_id" id="chapter_id" wire:model="selected_chapter_id" wire:change="setNewSelectedChapter" class="form-control">
                        @if($selected_topic)
                            <option value="" selected>All Questions</option>
                            @foreach ($selected_topic->chapters as $chapter)
                            <option value="{{ $chapter->id }}"
                                {{-- {{ (isset($question->chapter)  ? /* edit page */ ($question->chapter->id == $chapter->id ? "selected" : "") : /* create page */ ($loop->first ? "selected" : "") )}}> --}}
                                {{ (isset($question->chapter)  ? /* edit page */ ($question->chapter->id == $chapter->id ? "selected" : "") : '' )}}>
                                {{$chapter->title}}
                            </option>
                            @endforeach
                        @endif
                    </select>

                    <p class="help-block"></p>
                    @if($errors->has('chapter_id'))
                        <p class="help-block">
                            {{ $errors->first('chapter_id') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        @if( $questions && count($questions) > 0)
        <div class="panel-body">
        <?php $i = 1; ?>
        @foreach($questions as $question)
            @if ($i > 1) <hr /> @endif
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="form-group">
                        <strong>Question {{ $i }}.<br />{!! nl2br($question->question_text) !!}</strong>

                        @if ($question->code_snippet != '')
                            <div class="code_snippet">{!! $question->code_snippet !!}</div>
                        @endif

                        <input
                            type="hidden"
                            name="questions[{{ $i }}]"
                            value="{{ $question->id }}">
                    @foreach($question->options as $option)
                        <br>
                        <label class="radio-inline">
                            <input
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                value="{{ $option->id }}">
                            {{ $option->option }}
                        </label>
                    @endforeach
                    </div>
                </div>
            </div>
        <?php $i++; ?>
        @endforeach
        </div>
        @endif
    </div>
</div>
