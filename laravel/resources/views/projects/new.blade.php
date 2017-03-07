@extends('layouts.master')

@section('content')

    @include('layouts.partials.sidebar')

    <div class="col-sm-9 main">
        @include('layouts.partials.alerts')
        <h1 class="page-header">New Project</h1>

        <div class="col-lg-6">
            <form class="form-vertical" role="form" method="post" action="{{ route('projects.store') }}">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <label for="status" class="control-label">Choose Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" {{ (old("status") == "" ? "selected":"") }}>Choose a status</option>
                        <option value="Upcoming" {{ (old("status") == "Upcoming" ? "selected":"") }}>Upcoming</option>
                        <option value="Active" {{ (old("status") == "Active" ? "selected":"") }}>Active</option>
                        <option value="Completed" {{ (old("status") == "Completed" ? "selected":"") }}>Completed</option>
                    </select>
                    @if ($errors->has('status'))
                        <span class="help-block">{{ $errors->first('status') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') ?: '' }}">
                    @if ($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('due-date') ? ' has-error' : '' }}">
                    <label for="due-date" class="control-label">Due date</label>
                    <input type="date" name="due-date" class="form-control" id="due-date" value="{{ old('due-date') ?: '' }}">
                    @if ($errors->has('due-date'))
                        <span class="help-block">{{ $errors->first('due-date') }}</span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                    <label for="notes" class="control-label">Notes</label>
                    <textarea name="notes" class="form-control" id="notes" rows="10" cols="10">{{ old('notes') ?: '' }}</textarea>
                    @if ($errors->has('notes'))
                        <span class="help-block">{{ $errors->first('notes') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default">Create</button>
                </div>

            </form>
        </div>
    </div>
@stop