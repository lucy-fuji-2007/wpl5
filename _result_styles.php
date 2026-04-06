<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet"/>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  :root {
    --bg: #0b0c10; --surface: #13151c; --card: #1a1d28; --border: #2a2d3e;
    --accent: #6c63ff; --accent2: #ff6584;
    --text: #e8eaf6; --muted: #8589a5;
    --success: #4caf7d; --error: #ff5c5c; --radius: 14px;
  }
  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg); color: var(--text);
    min-height: 100vh; display: flex; align-items: center; justify-content: center;
    padding: 40px 20px;
  }
  body::before {
    content: ''; position: fixed;
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(108,99,255,0.12) 0%, transparent 70%);
    top: -100px; left: -100px; pointer-events: none;
  }
  .wrapper { width: 100%; max-width: 660px; position: relative; z-index: 1; }

  /* Banner */
  .banner {
    border-radius: 16px; padding: 28px 32px;
    display: flex; align-items: center; gap: 18px;
    margin-bottom: 24px;
    animation: fadeUp .5s ease both;
  }
  .banner.success { background: rgba(76,175,125,0.12); border: 1px solid rgba(76,175,125,0.35); }
  .banner.error   { background: rgba(255,92,92,0.1);  border: 1px solid rgba(255,92,92,0.35); }
  .banner-icon { font-size: 36px; flex-shrink: 0; }
  .banner h2 { font-family: 'Syne', sans-serif; font-size: 22px; font-weight: 800; }
  .banner p  { font-size: 14px; color: var(--muted); margin-top: 4px; }
  .banner.success h2 { color: var(--success); }
  .banner.error   h2 { color: var(--error); }

  /* Method badge */
  .method-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(108,99,255,0.12);
    border: 1px solid rgba(108,99,255,0.35);
    color: var(--accent);
    padding: 6px 14px; border-radius: 100px;
    font-size: 12px; font-weight: 700; letter-spacing: 1.5px;
    text-transform: uppercase; margin-bottom: 20px;
  }
  .method-badge::before { content: '⬤'; font-size: 8px; }

  /* Errors list */
  .errors-card {
    background: rgba(255,92,92,0.06);
    border: 1px solid rgba(255,92,92,0.25);
    border-radius: var(--radius); padding: 20px 24px;
    margin-bottom: 24px;
    animation: fadeUp .5s ease .1s both;
  }
  .errors-card h3 {
    font-family: 'Syne', sans-serif; font-size: 14px; font-weight: 700;
    color: var(--error); margin-bottom: 12px;
    text-transform: uppercase; letter-spacing: 1px;
  }
  .errors-card ul { list-style: none; display: flex; flex-direction: column; gap: 7px; }
  .errors-card li {
    font-size: 13.5px; color: #ff8a8a;
    padding-left: 18px; position: relative;
  }
  .errors-card li::before { content: '✕'; position: absolute; left: 0; color: var(--error); font-size: 11px; top: 1px; }
  .errors-card .field-name { font-weight: 600; color: var(--error); }

  /* Data table card */
  .data-card {
    background: var(--card); border: 1px solid var(--border);
    border-radius: 20px; overflow: hidden;
    animation: fadeUp .6s ease .15s both;
    box-shadow: 0 20px 60px rgba(0,0,0,0.35);
  }
  .data-card-header {
    padding: 20px 28px; border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
  }
  .data-card-header h3 {
    font-family: 'Syne', sans-serif; font-size: 16px; font-weight: 700;
    color: var(--text);
  }
  .data-card-header span {
    font-size: 11px; color: var(--muted); font-weight: 500;
    text-transform: uppercase; letter-spacing: 1px;
  }
  table { width: 100%; border-collapse: collapse; }
  tr { border-bottom: 1px solid var(--border); transition: background .15s; }
  tr:last-child { border-bottom: none; }
  tr:hover { background: rgba(255,255,255,0.02); }
  td {
    padding: 14px 28px; font-size: 14px; vertical-align: top;
  }
  td:first-child {
    color: var(--muted); font-weight: 600;
    font-size: 11.5px; text-transform: uppercase; letter-spacing: 0.8px;
    width: 36%; white-space: nowrap;
  }
  td:last-child { color: var(--text); }

  /* Action buttons */
  .actions { display: flex; gap: 12px; margin-top: 24px; animation: fadeUp .7s ease .2s both; }
  .btn {
    flex: 1; padding: 13px; border: none; cursor: pointer;
    border-radius: var(--radius);
    font-family: 'Syne', sans-serif; font-size: 14px; font-weight: 700;
    letter-spacing: .5px; text-decoration: none; text-align: center;
    transition: all .25s; display: block;
  }
  .btn-primary {
    background: linear-gradient(135deg, #6c63ff, #8b5cf6);
    color: #fff; box-shadow: 0 6px 20px rgba(108,99,255,0.4);
  }
  .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(108,99,255,0.5); }
  .btn-secondary {
    background: transparent; border: 1px solid var(--border); color: var(--muted);
  }
  .btn-secondary:hover { border-color: var(--accent); color: var(--accent); }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  @media (max-width: 520px) {
    .data-card-header, td { padding-left: 16px; padding-right: 16px; }
    td:first-child { width: 42%; }
    .actions { flex-direction: column; }
  }
</style>
