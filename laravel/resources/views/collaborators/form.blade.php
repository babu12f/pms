<div class="col-md-5">
    <div class="project">
        <h4 class="page-header">
            Collaborators
        </h4>
        @if( $collaborators)
            @foreach( $collaborators as $collaborator)
                <div class="colaboration">
                    <div>
                        <span>
                            <img src="{{ $collaborator->user()->first()->getAvatarUrl() }}" />
                        </span>
                    </div>
                    <button class="btn btn-sm btn-danger delete" style="margin-top:5px;padding:4px;width: 35px;"
                            data-action="/Prego/projects/{{ $project->id }}/collaborators/{{ $collaborator->id }}"
                            data-token="{{csrf_token()}}">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </div>
                <hr/>
            @endforeach
        @endif
        <form class="form-vertical" role="form" method="post" action="{{ route('projects.collaborators.create', $project->id) }}">
            <div class="form-group{{ $errors->has('collaborator') ? ' has-error' : '' }}">
                <label> Add New </label>
                {!! mention()->asText('collaborator', old('collaborator'), 'users', 'username', 'form-control') !!}
                @if ($errors->has('collaborator'))
                    <span class="help-block">{{ $errors->first('collaborator') }}</span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-info">Add User</button>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
</div>