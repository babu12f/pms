@extends('layouts.master')

@section('content')

    @include('layouts.partials.sidebar')
    <div class="col-sm-9 col-md-9 main">
        @include('layouts.partials.alerts')
        @if( $project )
            <h1 class="page-header">
                {!! $project->project_name !!}
            </h1>

            <div class="cont">
                <div class="row">
                    <div class="col-md-4">
                        <div class="project">
                            <p>Due : {!! date_format(new DateTime($project->due_date), "D, m Y") !!}</p>
                            <p>Status: {!! $project->project_status !!}</p>
                            <p>Tasks: {{ count($tasks) }} </p>
                            <p>Comments: {{ count($comments) }}</p>
                            <p>Attachments: {{ count($files) }} </p>
                            <p><a href="/projects/{{ $project->id }}/edit">Edit</a></p>
                            <button class="btn btn-circle btn-danger delete"
                                    data-action="{{ url('projects/' . $project->id) }}"
                                    data-token="{{csrf_token()}}">
                                <i class="fa fa-trash-o"></i>Delete
                            </button>
                        </div>
                    </div>
                    @include('collaborators.form')
                </div>
                <hr>
                <div class="row">
                    @include('tasks.form')
                    @include('files.form')
                </div>
                <hr>
                <div class="row">
                    @include('comments.form')
                </div>
            </div>
        @endif
    </div>
@stop