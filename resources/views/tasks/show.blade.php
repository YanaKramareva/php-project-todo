@extends('layouts.app')

@section('content')

    <h1 class="text-break">
        {{  __('tasks.View a task') . ": " . $task->name }}
        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">&#9881;</a>
    </h1>
    <p class="text-break">{{  __('tasks.Name') . ": " . $task->name }}</p>
    <p class="text-break">{{ __('taskStatuses.Status') . ": " . $task->status->name }}</p>
    <p class="text-break">{{ __('tasks.Description') . ": " . $task->description }}</p>
    <p class="text-break">{{ __('labels.Label') . ": " . $task->label->name }}</p>

@endsection('content')
