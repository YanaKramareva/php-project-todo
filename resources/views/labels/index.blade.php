@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{ __('labels.Labels') }}</h1>
        <table class="table mt-2">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col"  class="text-break">{{ __('labels.Label name') }}</th>
             </tr>
            </thead>
            @if ($labels)
                @foreach ($labels as $label)
                    <tr>
                        <td>{{ $label->id }}</td>
                        <td scope="row"> {{ $label->name }} </td>
                    </tr>
                @endforeach
            @endif
        </table>
        <nav>
            <ul class="pagination">
                <li>{{ $labels->onEachSide(3)->links() }}</li>
            </ul>
        </nav>
    </div>
@endsection
