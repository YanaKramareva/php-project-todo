@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('taskStatuses.Statuses') }}</h1>
        <table class="table mt-2">
            <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('taskStatuses.Status name') }}</th>
            </tr>
            </thead>
            @if ($taskStatuses)
                @foreach ($taskStatuses as $status)
                    <tr>
                        <td>{{ $status->id }}</td>
                        <td> {{ $status->name }} </td>
                    </tr>
                @endforeach
            @endif
        </table>
        <nav>
            <ul class="pagination">
                <li>{{ $taskStatuses->onEachSide(3)->links() }}</li>
            </ul>
        </nav>
    </div>
@endsection
