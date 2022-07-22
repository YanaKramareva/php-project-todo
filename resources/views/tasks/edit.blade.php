@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('tasks.Edit task') }}</h1>
    {{Form::model($task, ['url' => route('tasks.update', ['task' => $task]), 'method' => 'PATCH'])}}
    <div class="form-group mb-3">
        {{Form::label('name', __('tasks.Name'))}}
        {{Form::bsText('name', $task->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')])}}
    </div>
    <div class="form-group mb-3">
        {{Form::label('description', __('tasks.Description'))}}
        {{Form::textarea('description', null, ['class' => 'form-control', 'cols' => '20', 'rows' => '10'])}}
    </div>
    <div class="form-group mb-3">
        {{Form::label('status_id', __('taskStatuses.Status'))}}
        {{Form::bsSelect('status_id', $taskStatuses, null, ['placeholder' => '----------', 'class' => 'form-control' . ($errors->has('status_id') ? ' is-invalid' : '')])}}
    </div>
    <div class="form-group mb-3">
        {{Form::label('label_id', __('labels.Label'))}}
        {{Form::bsSelect('label_id', $taskLabels, null, ['placeholder' => '----------', 'class' => 'form-control' . ($errors->has('label_id') ? ' is-invalid' : '')])}}
    </div>
    {{Form::submit(__('tasks.Update'), ['class' => 'btn btn-info mt-3'])}}
    {{Form::close()}}
@endsection
