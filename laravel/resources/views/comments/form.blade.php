<h4 class="page-header">
    Comments
</h4>
<div class="row" style="margin-left:5px;padding:5px;">
    @if($comments)
        @foreach( $comments as $comment)
            <div class="col-md-10">
                <div><i class="fa fa-check-square-o"></i>
                    <span>{{ $comment->comments }} by
                       <span style="font-style: italic;color: #09f;">
                         {{ ($comment->user()->first()->username === auth()->user()->username) ? 'You' : $comment->user()->first()->username }}
                       </span>
                    </span></div>
                <a href="{{ url('projects') }}/{{ $project->id }}/comments/{{ $comment->id }}/edit">Edit</a>

                <button class="btn btn-danger delete pull-right"
                        data-action="/Prego/projects/{{ $project->id }}/comments/{{ $comment->id }}"
                        data-token="{{csrf_token()}}">
                    <i class="fa fa-trash-o"></i>Delete
                </button>
                <hr/>
            </div>

        @endforeach
    @endif

    <form class="form-vertical" role="form" method="post" action="{{ route('projects.comments.create', $project->id) }}">
        {!! csrf_field() !!}
        <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
            <textarea name="comments" class="form-control" style="width:80%;" id="comment" rows="5" cols="5"></textarea>
            @if ($errors->has('comments'))
                <span class="help-block">{{ $errors->first('comments') }}</span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-info">Add Comment</button>
        </div>

    </form>
</div>