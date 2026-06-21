@extends('layouts.app')

@section('content')
    <div class="animate-fade-up">
        <a href="{{ route('tasks.index') }}" class="text-slate-500 text-sm hover:text-slate-700 inline-flex items-center gap-1 mb-4">
            ←Back to tasks
        </a>

        <h1 class="text-2xl font-bold text-slate-800 mb-6">Create New Task</h1>

        <form action="{{ route('tasks.store') }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Write project report"
                       class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-shadow">
                @error('title')
                    <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Description (optional)</label>
                <textarea name="description" rows="3" placeholder="Write details..."
                          class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-shadow">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Due Date (optional)</label>
                <input type="date" name="due_date" value="{{ old('due_date') }}"
                       class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent transition-shadow">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-press bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-medium shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-colors">
                    Save Task
                </button>
                <a href="{{ route('tasks.index') }}" class="btn-press px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
