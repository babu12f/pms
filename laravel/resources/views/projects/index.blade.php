@extends('layouts.master')
@section('content')

    @include('layouts.partials.sidebar')
    <div class="col-md-9 col-sm-9  main">
        @include('layouts.partials.alerts')
        <h1 class="page-header">
            Projects
            <a class="btn btn-info" href="{{ route('projects.create') }}">New Project</a>
        </h1>

        @if($project)
                @foreach ($project as $proj)
                    <div class="col-md-4">
                        <div class="project">
                            <h2><a href="{{ url('projects/') }}/{{ $proj->id }}">{!! $proj->project_name !!}</a></h2>
                            <p>Due : {!! date_format(new DateTime($proj->due_date), "D, m Y") !!}</p>
                            <p>Status: {!! $proj->project_status !!}</p>
                            <p>Tasks: {{ $proj->tasks->count() }}</p>
                            <p>Comments: {{ $proj->comments->count() }}</p>
                            <p>Attachments: {{ $proj->files->count() }}</p>
                        </div>
                    </div>
                @endforeach
        @endif

        @if($project->isEmpty())
            <h3>There are currently no Projects</h3>
        @endif
    </div>
@stop