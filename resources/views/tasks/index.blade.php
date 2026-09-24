@extends('layouts.app')

@section('content')
    <section class="intro-row">
        <div>
            <p class="eyebrow">Your daily command center</p>
            <h1>Make space for <em>what matters.</em></h1>
            <p class="intro-copy">Keep the important work visible, moving, and finished.</p>
        </div>
        <div class="task-count">
            <strong>{{ $tasks->where('status', 'pending')->count() }}</strong>
            <span>open tasks</span>
        </div>
    </section>

    <section class="task-board">
        <div class="section-heading">
            <h2>Task list</h2>
            <span>{{ $tasks->count() }} {{ $tasks->count() === 1 ? 'task' : 'tasks' }}</span>
        </div>

        @forelse ($tasks as $task)
            <article class="task-item {{ $task->status === 'completed' ? 'is-complete' : '' }}">
                <form class="complete-form" method="POST" action="{{ route('tasks.update', [$task], false) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="title" value="{{ $task->title }}">
                    <input type="hidden" name="description" value="{{ $task->description }}">
                    <input type="hidden" name="due_date" value="{{ $task->due_date?->format('Y-m-d') }}">
                    <input type="hidden" name="status" value="{{ $task->status === 'completed' ? 'pending' : 'completed' }}">
                    <button class="status-button {{ $task->status === 'completed' ? 'done' : '' }}" type="submit" aria-label="Mark {{ $task->title }} as {{ $task->status === 'completed' ? 'pending' : 'completed' }}">
                        {{ $task->status === 'completed' ? '✓' : '' }}
                    </button>
                </form>
                <div class="task-details">
                    <h3>{{ $task->title }}</h3>
                    @if ($task->description)
                        <p>{{ $task->description }}</p>
                    @endif
                    <div class="task-meta">
                        <span class="status-pill {{ $task->status }}">{{ ucfirst($task->status) }}</span>
                        @if ($task->due_date)
                            <span class="due-date">Due {{ $task->due_date->format('M j, Y') }}</span>
                        @endif
                    </div>
                </div>
                <div class="task-actions">
                    <a class="icon-button" href="{{ route('tasks.edit', [$task], false) }}" title="Edit task" aria-label="Edit task">Edit</a>
                    <form method="POST" action="{{ route('tasks.destroy', [$task], false) }}" onsubmit="return confirm('Delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button class="icon-button danger" type="submit" title="Delete task" aria-label="Delete task">Delete</button>
                    </form>
                </div>
            </article>
        @empty
            <div class="empty-state">
                <span class="empty-mark">+</span>
                <h3>Your list is clear.</h3>
                <p>Start with one meaningful task and build from there.</p>
                <a class="button button-primary" href="{{ route('tasks.create', [], false) }}">Add your first task</a>
            </div>
        @endforelse
    </section>
@endsection
