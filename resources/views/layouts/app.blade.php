<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Task Manager' }} | Focus</title>
    <style>
        :root {
            --bg: #1F1F1F;
            --navy: #0A1A2F;
            --paper: #f3f1eb;
            --line: rgba(255,255,255,0.08);
            --muted: #d9d9d9;
            --green: #2bb673;
            --green-soft: rgba(43,182,115,0.18);
            --text: #f7f7f7;
            --shadow: rgba(0,0,0,0.18);
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; min-height: 100%; }
        body {
            background: var(--bg);
            color: var(--text);
            font-family: "Segoe UI", Arial, Helvetica, sans-serif;
            font-size: 15px;
            line-height: 1.45;
        }
        a { color: inherit; text-decoration: none; }
        .app-shell {
            min-height: 100vh;
            background: var(--bg);
        }
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--navy);
            color: white;
            padding: 12px 18px;
            border-bottom: 1px solid var(--line);
            box-shadow: 0 2px 8px var(--shadow);
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.02em;
        }
        .brand-mark {
            display: inline-grid;
            place-items: center;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--green);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
        }
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 34px;
            padding: 0 14px;
            border: none;
            border-radius: 6px;
            font-weight: 700;
            font-size: 12px;
            cursor: pointer;
            transition: transform 0.12s ease, box-shadow 0.12s ease, opacity 0.2s ease;
            box-shadow: 0 2px 0 rgba(0,0,0,0.18);
            appearance: none;
            -webkit-appearance: none;
        }
        .button:hover { opacity: 0.96; }
        .button:active {
            transform: translateY(1px);
            box-shadow: 0 1px 0 rgba(0,0,0,0.2);
        }
        .button:focus-visible {
            outline: 2px solid rgba(255,255,255,0.9);
            outline-offset: 2px;
        }
        .button-primary {
            background: var(--green);
            color: #fff;
        }
        .page-content {
            max-width: 1220px;
            margin: 0 auto;
            padding: 30px 24px 40px;
            background: var(--bg);
        }
        .intro-row {
            display: block;
            margin-bottom: 32px;
        }
        .eyebrow {
            margin: 0 0 12px;
            color: var(--text);
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }
        h1 {
            margin: 0;
            font-size: clamp(2.2rem, 4vw, 4rem);
            line-height: 1.08;
            font-weight: 800;
            letter-spacing: -0.05em;
            color: var(--text);
        }
        h1 em {
            font-style: normal;
            color: var(--text);
        }
        .intro-copy {
            margin-top: 16px;
            color: var(--muted);
            font-size: 15px;
        }
        .task-count {
            margin-top: 22px;
            color: var(--muted);
            font-size: 14px;
        }
        .task-count strong {
            display: block;
            font-size: 2.4rem;
            color: var(--text);
            line-height: 1;
        }
        .task-board {
            margin-top: 18px;
        }
        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            color: var(--text);
            font-size: 14px;
        }
        .section-heading h2 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }
        .empty-state {
            padding: 30px 0 0;
            color: var(--text);
        }
        .empty-state h3 {
            margin: 0 0 12px;
            font-size: 18px;
        }
        .empty-state p {
            margin: 0 0 16px;
            color: var(--muted);
            font-size: 15px;
        }
        .empty-mark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--green);
            color: #fff;
            font-size: 22px;
            margin-bottom: 14px;
        }
        .task-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 12px;
        }
        .task-details {
            flex: 1;
        }
        .task-details h3 {
            margin: 0 0 6px;
            font-size: 16px;
        }
        .status-pill {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }
        .status-pill.pending {
            background: rgba(245,197,66,0.18);
            color: #f5c542;
        }
        .status-pill.completed {
            background: var(--green-soft);
            color: var(--green);
        }
        .task-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .icon-button {
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: opacity 0.12s ease, transform 0.12s ease;
            appearance: none;
            -webkit-appearance: none;
        }
        .icon-button:hover { opacity: 0.9; }
        .icon-button:active {
            transform: translateY(1px);
        }
        .icon-button.danger {
            color: #ff8d7a;
        }
        .status-button {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.25);
            background: transparent;
            color: #fff;
            cursor: pointer;
            transition: transform 0.12s ease, background 0.12s ease, border-color 0.12s ease;
            appearance: none;
            -webkit-appearance: none;
        }
        .status-button:hover {
            background: rgba(255,255,255,0.06);
        }
        .status-button:active {
            transform: scale(0.96);
        }
        .status-button.done {
            background: var(--green);
            border-color: var(--green);
        }
        .form-page, .task-form {
            color: var(--text);
        }
        .form-page {
            max-width: 760px;
            margin: 0 auto;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 28px;
            color: var(--muted);
            font-size: 12px;
        }
        .back-link:hover { color: var(--text); }
        .form-heading { margin-bottom: 28px; }
        .form-heading h1 { font-size: clamp(2.2rem, 4vw, 3.5rem); }
        .task-form {
            padding: 24px;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--line);
            border-radius: 10px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .field {
            display: flex;
            flex-direction: column;
            gap: 9px;
            min-width: 0;
        }
        .field-wide { grid-column: 1 / -1; }
        .field > span {
            min-height: 18px;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
            line-height: 18px;
        }
        .field b { color: #ff8d7a; }
        .field small { margin-left: 6px; color: #b9c0c2; font-size: 12px; font-weight: 400; }
        .field input, .field textarea, .field select {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--line);
            color: var(--text);
            padding: 0 12px;
            border-radius: 8px;
            font-size: 14px;
            line-height: 20px;
        }
        .field input, .field select { height: 44px; }
        .field input::placeholder, .field textarea::placeholder { color: #c7ccce; opacity: 1; }
        .field input[type="date"] { color-scheme: dark; }
        .field textarea { min-height: 110px; padding: 11px 12px; resize: vertical; }
        .field select option { color: #1F1F1F; background: #fff; }
        .field input:focus, .field textarea:focus, .field select:focus {
            outline: 2px solid rgba(43,182,115,0.45);
            border-color: var(--green);
        }
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--line);
        }
        .button-quiet { background: transparent; color: var(--muted); }
        .alert { margin-bottom: 16px; padding: 10px 12px; border-radius: 8px; }
        .alert-success { background: var(--green-soft); color: #dfffee; }
        .alert-error { background: rgba(255,141,122,0.16); color: #ffd2c9; }
        .alert ul { margin: 8px 0 0; padding-left: 18px; }
        @media (max-width: 640px) {
            .topbar { padding: 12px; }
            .page-content { padding: 24px 16px 40px; }
            .form-grid { grid-template-columns: 1fr; }
            .field-wide { grid-column: auto; }
            .task-item { align-items: flex-start; }
        }
    </style>
</head>
<body>
    <div class="app-shell">
        <header class="topbar">
            <a class="brand" href="{{ route('tasks.index', [], false) }}">
                <span class="brand-mark">K</span>
                <span>Task Manager</span>
            </a>
            <a class="button button-primary" href="{{ route('tasks.create', [], false) }}">
                <span class="button-icon">+</span> New task
            </a>
        </header>

        <main class="page-content">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    <strong>Please check the form.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
