@extends('layouts.app')

@section('content')
    <section class="form-page">
        <a class="back-link" href="{{ route('tasks.index', [], false) }}">&larr; Back to task list</a>
        <div class="form-heading">
            <p class="eyebrow">Refine the details</p>
            <h1>Edit your <em>task.</em></h1>
            <p class="intro-copy">Keep the next step clear and current.</p>
        </div>
        <form class="task-form" method="POST" action="{{ route('tasks.update', [$task], false) }}">
            @method('PUT')
            @include('tasks._form')
        </form>
    </section>
@endsection
