@extends('layouts.app')

@section('content')
<h1>Tasks</h1>
@foreach($tasks as $task)
    <div>
        <h3>{{ $task->title }}</h3>
        <p>{{ $task->description }}</p>
    </div>
@endforeach
@endsection
