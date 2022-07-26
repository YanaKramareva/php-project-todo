@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container px-6 text-center">
            <div class="row gx-5">
                <div class="col-md-6">
                <div class="p-3 border bg-light">
                        <h2 class="mb-5">{{ __('tasks.TODOS')}}</h2>
                        <table class="table me-2">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col" class="text-break">{{ __('taskStatuses.Status') }}</th>
                                <th scope="col" class="text-break">{{ __('labels.Label') }}</th>
                                <th scope="col" class="text-break">{{ __('tasks.Name') }}</th>
                                <th scope="col" class="text-break">{{ __('tasks.Author') }}</th>
                                <th scope="col">{{ __('tasks.Date of creation') }}</th>
                                @if(Auth::check())
                                    <th scope="col">{{ __('tasks.Actions') }}</th>
                                @endif
                            </tr>
                            </thead>
                            @if ($tasks)
                                @foreach ($tasks as $task)
                                    @if ($task->label->name === 'not urgent')
                                        <tr>
                                            <td>{{ $task->id }}</td>
                                            <td> {{ $task->status->name }} </td>
                                            <td> {{ $task->label->name }} </td>
                                            <td><a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->name }}</a></td>
                                            <td>{{ $task->creator->name }}</td>
                                            <td>{{ $task->created_at->format('d.m.Y') }}</td>
                                            @if(Auth::check())
                                                <td>
                                                    @can('delete', $task)
                                                        <a class="text-danger" href="{{ route('tasks.destroy', ['task' => $task->id]) }}" data-method="delete" rel="nofollow" data-confirm="{{ __('tasks.Are you sure?') }}">{{ __('tasks.Delete') }}</a>
                                                    @endcan
                                                    @can('update', $task)
                                                        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">{{ __('tasks.Edit') }}</a>
                                                    @endcan
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                                <h3 class="mb-5">{{count($tasks)}}</h3>
                            @endif
                        </table>
                    <div class="ms-auto">
                        @if(Auth::check())
                            <a href="{{ route('tasks.create') }}" class="btn btn-info ml-auto">{{ __('tasks.Create task') }}</a>
                        @endif
                        <div class="d-flex mb-3">
                        </div>
                    </div>

                </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border bg-light">
                        <h2 class="mb-5">{{ __('tasks.Urgent TODOS')}}</h2>
                        <table class="table me-2">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col" class="text-break">{{ __('taskStatuses.Status') }}</th>
                                <th scope="col" class="text-break">{{ __('labels.Label') }}</th>
                                <th scope="col" class="text-break">{{ __('tasks.Name') }}</th>
                                <th scope="col" class="text-break">{{ __('tasks.Author') }}</th>
                                <th scope="col">{{ __('tasks.Date of creation') }}</th>
                                @if(Auth::check())
                                    <th scope="col">{{ __('tasks.Actions') }}</th>
                                @endif
                            </tr>
                            </thead>
                            @if ($tasks)
                                @foreach ($tasks as $task)
                                    @if ($task->label->name === 'urgent')
                                        <tr>
                                            <td>{{ $task->id }}</td>
                                            <td> {{ $task->status->name }} </td>
                                            <td> {{ $task->label->name }} </td>
                                            <td><a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->name }}</a></td>
                                            <td>{{ $task->creator->name }}</td>
                                            <td>{{ $task->created_at->format('d.m.Y') }}</td>
                                            @if(Auth::check())
                                                <td>
                                                    @can('delete', $task)
                                                        <a class="text-danger" href="{{ route('tasks.destroy', ['task' => $task->id]) }}" data-method="delete" rel="nofollow" data-confirm="{{ __('tasks.Are you sure?') }}">{{ __('tasks.Delete') }}</a>
                                                    @endcan
                                                    @can('update', $task)
                                                        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">{{ __('tasks.Edit') }}</a>
                                                    @endcan
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
