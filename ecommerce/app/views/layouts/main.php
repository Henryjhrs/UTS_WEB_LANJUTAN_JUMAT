<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'MandalaShop') ?> — MandalaShop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0d0f14;
            --surface:   #161922;
            --surface2:  #1e2330;
            --border:    #2a3045;
            --accent:    #4f8ef7;
            --accent2:   #34d399;
            --warn:      #f59e0b;
            --danger:    #ef4444;
            --text:      #e8ecf4;
            --muted:     #6b7a99;
            --sidebar-w: 240px;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
            font-size: 14px;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-brand .logo {
            font-size: 20px;
            font-weight: 700;
            color: var(--accent);
            letter-spacing: -0.5px;
        }
        .sidebar-brand .tagline {
            font-size: 11px;
            color: var(--muted);
            margin-top: 2px;
            font-family: 'JetBrains Mono', monospace;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-label {
            font-size: 10px;
            font-weight: 600;
            color: var(--muted);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 8px 8px 4px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--muted);
            font-weight: 500;
            transition: all .15s;
        }
        .nav-link:hover  { background: var(--surface2); color: var(--text); }
        .nav-link.active { background: rgba(79,142,247,.15); color: var(--accent); }
        .nav-link .icon  { font-size: 16px; width: 20px; text-align: center; }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 28px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar-title {
            font-size: 16px;
            font-weight: 600;
        }
        .topbar-badge {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 12px;
            color: var(--muted);
            font-family: 'JetBrains Mono', monospace;
        }

        .page-content {
            padding: 28px;
            flex: 1;
        }

        /* ── CARDS ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }
        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-title {
            font-size: 15px;
            font-weight: 600;
        }
        .card-body { padding: 24px; }

        /* ── STATS GRID ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
        }
        .stat-card.blue::before   { background: var(--accent); }
        .stat-card.green::before  { background: var(--accent2); }
        .stat-card.amber::before  { background: var(--warn); }
        .stat-card.red::before    { background: var(--danger); }

        .stat-icon { font-size: 24px; margin-bottom: 10px; }
        .stat-val  { font-size: 26px; font-weight: 700; line-height: 1; }
        .stat-lbl  { font-size: 12px; color: var(--muted); margin-top: 4px; }

        /* ── TABLE ── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th {
            text-align: left;
            padding: 10px 16px;
            font-size: 11px;
            font-weight: 600;
            color: var(--muted);
            letter-spacing: .8px;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border);
        }
        td {
            padding: 13px 16px;
            border-bottom: 1px solid rgba(42,48,69,.5);
            vertical-align: middle;
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(79,142,247,.04); }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all .15s;
        }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: #3a7de8; }
        .btn-success { background: var(--accent2); color: #0d1a14; }
        .btn-success:hover { filter: brightness(1.1); }
        .btn-warning { background: var(--warn); color: #1a1200; }
        .btn-danger  { background: var(--danger); color: #fff; }
        .btn-ghost   { background: var(--surface2); color: var(--text); border: 1px solid var(--border); }
        .btn-ghost:hover { border-color: var(--accent); color: var(--accent); }
        .btn-sm { padding: 5px 10px; font-size: 12px; border-radius: 6px; }

        /* ── FORM ── */
        .form-grid { display: grid; gap: 18px; }
        .form-row  { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            transition: border-color .15s;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--accent);
        }
        textarea.form-control { resize: vertical; min-height: 90px; }
        select.form-control { cursor: pointer; }
        select.form-control option { background: var(--surface2); }

        /* ── BADGES ── */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
        }
        .badge-green  { background: rgba(52,211,153,.15); color: var(--accent2); }
        .badge-amber  { background: rgba(245,158,11,.15); color: var(--warn); }
        .badge-red    { background: rgba(239,68,68,.15);  color: var(--danger); }
        .badge-blue   { background: rgba(79,142,247,.15); color: var(--accent); }

        /* ── FLASH ── */
        .flash {
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .flash-success { background: rgba(52,211,153,.12); border: 1px solid rgba(52,211,153,.3); color: var(--accent2); }
        .flash-error   { background: rgba(239,68,68,.12);  border: 1px solid rgba(239,68,68,.3);  color: var(--danger); }

        /* ── MISC ── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .page-header h2 { font-size: 20px; font-weight: 700; }
        .text-muted { color: var(--muted); }
        .text-mono  { font-family: 'JetBrains Mono', monospace; }
        .mt-1 { margin-top: 4px; }
        .mb-4 { margin-bottom: 16px; }
        .actions { display: flex; gap: 6px; }
        .empty-state {
            text-align: center;
            padding: 48px;
            color: var(--muted);
        }
        .empty-state .big-icon { font-size: 48px; margin-bottom: 12px; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<!-- GANTI BAGIAN SIDEBAR MENJADI SEPERTI INI -->

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="logo">
            <i class="fa-solid fa-store"></i> MandalaShop
        </div>
        <div class="tagline">e-commerce</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Menu</div>

        <a href="?page=dashboard" class="nav-link <?= ($page ?? '') === 'dashboard' || ($page ?? '') === '' ? 'active' : '' ?>">
            <span class="icon">
                <i class="fa-solid fa-gauge-high"></i>
            </span>
            Dashboard
        </a>

        <div class="nav-label" style="margin-top:8px;">Manajemen</div>

        <a href="?page=kategori" class="nav-link <?= ($page ?? '') === 'kategori' ? 'active' : '' ?>">
            <span class="icon">
                <i class="fa-solid fa-tags"></i>
            </span>
            Kategori
        </a>

        <a href="?page=produk" class="nav-link <?= ($page ?? '') === 'produk' ? 'active' : '' ?>">
            <span class="icon">
                <i class="fa-solid fa-box-open"></i>
            </span>
            Produk
        </a>

        <a href="?page=supplier" class="nav-link <?= ($page ?? '') === 'supplier' ? 'active' : '' ?>">
            <span class="icon">
                <i class="fa-solid fa-truck-fast"></i>
            </span>
            Supplier
        </a>

        <a href="?page=transaksi" class="nav-link <?= ($page ?? '') === 'transaksi' ? 'active' : '' ?>">
            <span class="icon">
                <i class="fa-solid fa-money-check-dollar"></i>
            </span>
            Transaksi
        </a>
    </nav>
</aside>

<!-- MAIN CONTENT -->
<main class="main">
    <div class="topbar">
        <span class="topbar-title"><?= htmlspecialchars($title ?? 'Dashboard') ?></span>
        <span class="topbar-badge"><?= date('d M Y') ?></span>
    </div>
    <div class="page-content">
        <?php if (!empty($flash)): ?>
            <div class="flash flash-<?= $flash['type'] ?>">
                <?= $flash['type'] === 'success' ? '✓' : '✕' ?>
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>
        <?= $content ?>
    </div>
</main>

</body>
</html>
