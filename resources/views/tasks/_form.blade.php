@csrf
<div class="form-grid">
    <label class="field field-wide">
        <span>Task title <b>*</b></span>
        <input type="text" name="title" value="{{ old('title', $task->title ?? '') }}" placeholder="What needs your attention?" required maxlength="120" autofocus>
    </label>

    <label class="field field-wide">
        <span>Notes <small>Optional</small></span>
        <textarea name="description" rows="5" placeholder="Add a little context...">{{ old('description', $task->description ?? '') }}</textarea>
    </label>

    <label class="field">
        <span>Due date <small>Optional</small></span>
        <input type="date" name="due_date" value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
    </label>

    <label class="field">
        <span>Status</span>
        <select name="status">
            <option value="pending" @selected(old('status', $task->status ?? 'pending') === 'pending')>Pending</option>
            <option value="completed" @selected(old('status', $task->status ?? 'pending') === 'completed')>Completed</option>
        </select>
    </label>
</div>
<div class="form-actions">
    <a class="button button-quiet" href="{{ route('tasks.index', [], false) }}">Cancel</a>
    <button class="button button-primary" type="submit">{{ isset($task) ? 'Save changes' : 'Add task' }}</button>
</div>
