<div class="col-md-5">
    <h4 class="page-header">
        Files
    </h4>
    <div class="row" style="border:1px solid #ccc;margin-left:5px;width:100%;padding:15px;">

        @if( $files)
            <?php $i=1; ?>
            @foreach( $files as $file)

                    <div class="clearfix">
                        <div><i class="fa fa-check-square-o"></i><span><a href="{{ $file->file_url }}" target="_blank">File-{{ $i }}</a></span></div>
                        <button id="task" class="btn btn-danger delete pull-right"
                                data-action="/Prego/projects/{{ $project->id   }}/files/{{ $file->id  }}"
                                data-token="{{csrf_token()}}">
                            <i class="fa fa-trash-o"></i>Delete
                        </button>
                    </div>
                    <hr/>
                <?php $i++; ?>
            @endforeach
        @endif

        <form class="form-vertical" role="form" enctype="multipart/form-data" method="post" action="{{ route('projects.files', ['projects' => $project->id]) }}">
            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('file_name') ? ' has-error' : '' }}">
                <input type="file" name="file_name" class="form-control" id="file_name">
                @if ($errors->has('file_name'))
                    <span class="help-block">{{ $errors->first('file_name') }}</span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-info">Add Files</button>
            </div>

        </form>
    </div>
</div>