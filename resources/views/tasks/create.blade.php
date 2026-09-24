@extends('layouts.app')

@section('content')
    <section class="form-page">
        <a class="back-link" href="{{ route('tasks.index', [], false) }}">&larr; Back to task list</a>
        <div class="form-heading">
            <p class="eyebrow">New entry</p>
            <h1>Add a <em>new task.</em></h1>
            <p class="intro-copy">Give your next important action a clear place to land.</p>
        </div>
        <form class="task-form" method="POST" action="{{ route('tasks.store', [], false) }}">
            @include('tasks._form')
        </form>
    </section>
@endsection
