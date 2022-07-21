@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('tasks.Create task') }}</h1>
    {{Form::open(['url' => route('tasks.store'), 'class' => 'w-50'])}}
    <div class="form-group mb-3">
        {{Form::label('name', __('tasks.Name'))}}
        {{Form::bsText('name', $task->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')])}}
    </div>
    <div class="form-group mb-3">
        {{Form::label('description', __('tasks.Description'))}}
        {{Form::textarea('description', null, ['class' => 'form-control', 'cols' => '50', 'rows' => '10'])}}
    </div>
    <div class="form-group mb-3">
        {{Form::label('status_id', __('taskStatuses.Status'))}}
        {{Form::bsSelect('status_id', $taskStatuses, null, ['placeholder' => '----------', 'class' => 'form-control' . ($errors->has('status_id') ? ' is-invalid' : '')])}}
    </div>
        <div class="form-group mb-3">
            {{Form::label('label_id', __('labels.Label'))}}
            {{Form::bsSelect('label_id', $taskLabels, null, ['placeholder' => '----------', 'class' => 'form-control' . ($errors->has('label_id') ? ' is-invalid' : '')])}}
        </div>
    {{Form::submit(__('tasks.Create'), ['class' => 'btn btn-info mt-3'])}}
    {{Form::close()}}
@endsection
