<div>
    <div class="row">
        <div class="col-xs-12 form-group">
            <label for="topic_id" class="control-label">Topic*</label>

            <select name="topic_id" id="topic_id" wire:model="selected_topic_id" wire:change="setNewSelectedTopic" class="form-control">
                <option value="">Please select..</option>
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
        <div class="col-xs-12 form-group">
            <label for="chapter_id" class="control-label">Chapter*</label>

            <select name="chapter_id" id="chapter_id" class="form-control">
                @if($selected_topic)
                        @foreach ($selected_topic->chapters as $chapter)
                        <option value="{{ $chapter->id }}"
                            {{ (isset($question->chapter)  ? /* edit page */ ($question->chapter->id == $chapter->id ? "selected" : "") : /* create page */ ($loop->first ? "selected" : "") )}}>
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

