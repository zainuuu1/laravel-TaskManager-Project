<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeInUp 0.4s ease-out both; }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-slide-down { animation: slideDown 0.3s ease-out both; }

        .task-card { transition: all 0.25s ease; }
        .task-card:hover { transform: translateY(-2px); box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); }

        .btn-press:active { transform: scale(0.95); }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-indigo-50 to-slate-100 min-h-screen">
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 px-6 py-4 sticky top-0 z-10 shadow-sm">
        <div class="max-w-3xl mx-auto flex justify-between items-center">
            <a href="{{ route('tasks.index') }}" class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <span class="bg-indigo-600 text-white w-9 h-9 rounded-xl flex items-center justify-center text-lg">✓</span>
                Task Manager
            </a>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto mt-8 px-4 pb-16">
        @if (session('success'))
            <div class="animate-slide-down bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-3 rounded-xl mb-5 flex items-center gap-2 shadow-sm">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
