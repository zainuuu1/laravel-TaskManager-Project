@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">My All Tasks</h1>
            <p class="text-slate-500 text-sm mt-1">
                {{ $tasks->where('is_completed', false)->count() }} pending,
                {{ $tasks->where('is_completed', true)->count() }} complete
            </p>
        </div>
        <a href="{{ route('tasks.create') }}"
           class="btn-press bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-medium shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-colors">
            + New Task
        </a>
    </div>

    @if ($tasks->isEmpty())
        <div class="text-center mt-20 animate-fade-up">
            <div class="text-5xl mb-3">🗒️</div>
            <p class="text-gray-400">No Task Yet.. Create your first task!!</p>
        </div>
    @endif

    <div class="space-y-3">
        @foreach ($tasks as $index => $task)
            <div class="task-card animate-fade-up bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex justify-between items-start {{ $task->is_completed ? 'opacity-60' : '' }}"
                 style="animation-delay: {{ $index * 60 }}ms">
                <div class="flex-1 min-w-0">
                    <h2 class="text-lg font-semibold {{ $task->is_completed ? 'line-through text-gray-400' : 'text-slate-800' }}">
                        {{ $task->title }}
                    </h2>
                    @if ($task->description)
                        <p class="text-gray-500 text-sm mt-1.5">{{ $task->description }}</p>
                    @endif
                    @if ($task->due_date)
                        <p class="text-xs text-slate-400 mt-2.5 inline-flex items-center gap-1 bg-slate-50 px-2 py-1 rounded-md">
                            📅 {{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}
                        </p>
                    @endif
                </div>

                <div class="flex gap-2 ml-4 shrink-0">
                    <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="btn-press text-sm px-3 py-1.5 rounded-lg font-medium transition-colors {{ $task->is_completed ? 'bg-amber-50 text-amber-600 hover:bg-amber-100' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }}">
                            {{ $task->is_completed ? '↺ Undo' : '✓ Done' }}
                        </button>
                    </form>

                    <a href="{{ route('tasks.edit', $task) }}"
                       class="btn-press text-sm px-3 py-1.5 rounded-lg font-medium bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors">
                        Edit
                    </a>

                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?
?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn-press text-sm px-3 py-1.5 rounded-lg font-medium bg-red-50 text-red-600 hover:bg-red-100 transition-colors">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
