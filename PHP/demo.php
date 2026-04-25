<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SafeRide — Passenger Safety Monitor</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #0a0a0f;
    --surface: #13131a;
    --surface2: #1c1c27;
    --border: rgba(255,255,255,0.07);
    --text: #f0f0f8;
    --muted: #7070a0;
    --safe: #00d4a0;
    --safe-dim: rgba(0,212,160,0.12);
    --warn: #f0a040;
    --warn-dim: rgba(240,160,64,0.12);
    --danger: #ff4455;
    --danger-dim: rgba(255,68,85,0.12);
    --font-head: 'Syne', sans-serif;
    --font-mono: 'Space Mono', monospace;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    background: var(--bg);
    color: var(--text);
    font-family: var(--font-head);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 24px 16px 48px;
    position: relative;
    overflow-x: hidden;
  }

  body::before {
    content: '';
    position: fixed;
    top: -40%;
    left: 50%;
    transform: translateX(-50%);
    width: 600px;
    height: 600px;
    background: radial-gradient(ellipse, rgba(0,212,160,0.04) 0%, transparent 70%);
    pointer-events: none;
    transition: background 1s ease;
    z-index: 0;
  }

  body.state-warn::before { background: radial-gradient(ellipse, rgba(240,160,64,0.07) 0%, transparent 70%); }
  body.state-danger::before { background: radial-gradient(ellipse, rgba(255,68,85,0.1) 0%, transparent 60%); }

  .container { width: 100%; max-width: 480px; position: relative; z-index: 1; }

  /* Header */
  .header { text-align: center; margin-bottom: 32px; padding-top: 8px; }
  .logo { font-size: 11px; font-family: var(--font-mono); letter-spacing: 0.2em; color: var(--muted); margin-bottom: 8px; }
  .title { font-size: 28px; font-weight: 800; letter-spacing: -0.02em; }
  .title span { color: var(--safe); }
  .subtitle { font-size: 13px; color: var(--muted); margin-top: 6px; font-family: var(--font-mono); }

  /* Main orb */
  .orb-wrap { display: flex; justify-content: center; margin-bottom: 28px; }
  .orb {
    width: 180px; height: 180px; border-radius: 50%;
    border: 2px solid var(--safe);
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    position: relative; cursor: pointer;
    transition: border-color 0.4s, box-shadow 0.4s;
    box-shadow: 0 0 40px rgba(0,212,160,0.15), inset 0 0 40px rgba(0,212,160,0.04);
  }
  .orb.warn { border-color: var(--warn); box-shadow: 0 0 50px rgba(240,160,64,0.25), inset 0 0 40px rgba(240,160,64,0.06); }
  .orb.danger { border-color: var(--danger); box-shadow: 0 0 60px rgba(255,68,85,0.35), inset 0 0 40px rgba(255,68,85,0.08); animation: throb 0.8s ease-in-out infinite; }
  .orb.sos { border-color: var(--danger); box-shadow: 0 0 80px rgba(255,68,85,0.5), inset 0 0 40px rgba(255,68,85,0.12); animation: throb 0.4s ease-in-out infinite; }

  @keyframes throb {
    0%,100% { transform: scale(1); }
    50% { transform: scale(1.04); }
  }

  .orb-ring {
    position: absolute; inset: -12px; border-radius: 50%;
    border: 1px solid rgba(0,212,160,0.2);
    transition: border-color 0.4s;
    animation: spin-slow 8s linear infinite;
  }
  .orb.warn .orb-ring { border-color: rgba(240,160,64,0.2); }
  .orb.danger .orb-ring, .orb.sos .orb-ring { border-color: rgba(255,68,85,0.25); }

  @keyframes spin-slow { to { transform: rotate(360deg); } }

  .orb-icon { font-size: 42px; line-height: 1; margin-bottom: 4px; }
  .orb-label { font-size: 13px; font-weight: 600; letter-spacing: 0.08em; color: var(--safe); transition: color 0.4s; }
  .orb.warn .orb-label { color: var(--warn); }
  .orb.danger .orb-label, .orb.sos .orb-label { color: var(--danger); }
  .orb-sub { font-family: var(--font-mono); font-size: 10px; color: var(--muted); margin-top: 4px; }

  /* Meters */
  .meters { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px; }
  .meter {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 14px 16px;
  }
  .meter-head { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
  .meter-name { font-size: 10px; font-family: var(--font-mono); letter-spacing: 0.1em; color: var(--muted); }
  .meter-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--safe); animation: blink 2s ease-in-out infinite; }
  @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }
  .meter-val { font-size: 26px; font-weight: 700; line-height: 1; }
  .meter-unit { font-size: 11px; font-family: var(--font-mono); color: var(--muted); margin-top: 2px; }
  .meter-bar { height: 3px; background: rgba(255,255,255,0.06); border-radius: 2px; margin-top: 10px; overflow: hidden; }
  .meter-fill { height: 100%; border-radius: 2px; transition: width 0.4s ease, background 0.4s; }

  /* Waveform */
  .wave-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 14px 16px;
    margin-bottom: 20px;
  }
  .wave-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
  .wave-label { font-size: 10px; font-family: var(--font-mono); letter-spacing: 0.1em; color: var(--muted); }
  .wave-status { font-size: 10px; font-family: var(--font-mono); color: var(--safe); }
  canvas#waveCanvas { width: 100%; height: 56px; display: block; border-radius: 6px; }

  /* Mic button */
  .mic-section { text-align: center; margin-bottom: 20px; }
  .mic-btn {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 14px 28px;
    background: var(--safe-dim);
    border: 1px solid var(--safe);
    border-radius: 50px;
    color: var(--safe);
    font-family: var(--font-head);
    font-size: 14px; font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    letter-spacing: 0.05em;
  }
  .mic-btn:hover { background: rgba(0,212,160,0.2); }
  .mic-btn.active { background: rgba(0,212,160,0.2); animation: mic-pulse 1.5s ease-in-out infinite; }
  .mic-btn.disabled { opacity: 0.4; cursor: not-allowed; }
  @keyframes mic-pulse { 0%,100%{box-shadow:0 0 0 0 rgba(0,212,160,0.3)} 50%{box-shadow:0 0 0 10px rgba(0,212,160,0)} }
  .mic-dot { width: 10px; height: 10px; border-radius: 50%; background: var(--safe); }
  .mic-btn.active .mic-dot { animation: blink 0.8s ease-in-out infinite; }

  /* Thresholds info */
  .thresholds {
    display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 20px;
  }
  .thresh-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 10px 12px;
    font-size: 11px; font-family: var(--font-mono); color: var(--muted);
  }
  .thresh-card strong { color: var(--text); display: block; margin-bottom: 2px; font-size: 12px; }

  /* Log */
  .log-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 14px 16px;
    margin-bottom: 20px;
  }
  .log-head { font-size: 10px; font-family: var(--font-mono); letter-spacing: 0.1em; color: var(--muted); margin-bottom: 10px; }
  .log-inner { max-height: 80px; overflow-y: auto; }
  .log-line { font-size: 11px; font-family: var(--font-mono); padding: 3px 0; border-bottom: 1px solid rgba(255,255,255,0.04); color: var(--muted); }
  .log-line:last-child { border-bottom: none; }
  .log-line.ok { color: var(--safe); }
  .log-line.wn { color: var(--warn); }
  .log-line.er { color: var(--danger); }

  /* SOS Button */
  .sos-btn {
    display: none; width: 100%;
    padding: 18px;
    background: var(--danger);
    border: none; border-radius: 14px;
    color: white;
    font-family: var(--font-head);
    font-size: 18px; font-weight: 800;
    letter-spacing: 0.05em;
    cursor: pointer;
    margin-bottom: 10px;
    animation: sos-flash 0.6s ease-in-out infinite;
  }
  .sos-btn.visible { display: block; }
  @keyframes sos-flash { 0%,100%{opacity:1} 50%{opacity:0.75} }

  .safe-reply-btn {
    display: none; width: 100%;
    padding: 14px;
    background: var(--safe-dim);
    border: 1px solid var(--safe); border-radius: 14px;
    color: var(--safe);
    font-family: var(--font-head);
    font-size: 14px; font-weight: 700;
    cursor: pointer;
    margin-bottom: 20px;
  }
  .safe-reply-btn.visible { display: block; }

  /* Modal */
  .modal-bg {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.75); backdrop-filter: blur(4px);
    z-index: 100; align-items: center; justify-content: center;
  }
  .modal-bg.visible { display: flex; }
  .modal {
    background: var(--surface);
    border: 1px solid var(--danger);
    border-radius: 20px;
    padding: 32px 28px; max-width: 320px; width: 90%;
    text-align: center;
    box-shadow: 0 0 60px rgba(255,68,85,0.2);
  }
  .modal-icon { font-size: 40px; margin-bottom: 12px; }
  .modal h2 { font-size: 20px; font-weight: 800; margin-bottom: 8px; }
  .modal p { font-size: 13px; color: var(--muted); font-family: var(--font-mono); margin-bottom: 20px; line-height: 1.6; }
  .modal-count { font-size: 48px; font-weight: 800; color: var(--danger); font-family: var(--font-mono); margin-bottom: 20px; }
  .modal .btn-yes {
    width: 100%; padding: 14px;
    background: var(--safe); border: none; border-radius: 10px;
    color: #000; font-family: var(--font-head); font-size: 14px; font-weight: 800;
    cursor: pointer; margin-bottom: 10px;
  }
  .modal .btn-no {
    width: 100%; padding: 12px;
    background: var(--danger-dim); border: 1px solid var(--danger); border-radius: 10px;
    color: var(--danger); font-family: var(--font-head); font-size: 13px; font-weight: 700;
    cursor: pointer;
  }

  /* SOS Full screen */
  .sos-screen {
    display: none; position: fixed; inset: 0;
    background: #1a0008; z-index: 200;
    flex-direction: column; align-items: center; justify-content: center;
    text-align: center; padding: 32px;
  }
  .sos-screen.visible { display: flex; animation: sos-bg 1s ease-in-out infinite; }
  @keyframes sos-bg { 0%,100%{background:#1a0008} 50%{background:#220010} }
  .sos-screen .big-sos { font-size: 72px; font-weight: 800; color: var(--danger); letter-spacing: 0.1em; font-family: var(--font-mono); animation: throb 0.5s ease-in-out infinite; }
  .sos-screen h3 { font-size: 20px; font-weight: 700; margin: 12px 0 8px; }
  .sos-screen p { font-size: 13px; color: var(--muted); font-family: var(--font-mono); max-width: 280px; line-height: 1.6; margin-bottom: 8px; }
  .sos-screen .loc { font-size: 11px; font-family: var(--font-mono); color: var(--danger); margin-bottom: 28px; }
  .sos-screen .cancel { padding: 12px 24px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); border-radius: 10px; color: var(--muted); font-family: var(--font-head); font-size: 13px; font-weight: 600; cursor: pointer; }

  /* Demo bar */
  .demo-bar {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 14px 16px;
    margin-bottom: 20px;
  }
  .demo-bar-head { font-size: 10px; font-family: var(--font-mono); letter-spacing: 0.1em; color: var(--muted); margin-bottom: 10px; }
  .demo-btns { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
  .demo-btn {
    padding: 9px 10px;
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 8px;
    color: var(--text);
    font-family: var(--font-mono);
    font-size: 11px; cursor: pointer;
    transition: border-color 0.15s, background 0.15s;
    text-align: left; line-height: 1.4;
  }
  .demo-btn:hover { border-color: rgba(255,255,255,0.15); background: rgba(255,255,255,0.04); }
  .demo-btn.reset { color: var(--muted); }

  .note { font-size: 11px; font-family: var(--font-mono); color: var(--muted); text-align: center; margin-top: 4px; opacity: 0.6; }
</style>
</head>
<body>

<div class="container">
  <div class="header">
    <div class="logo">SAFERIDE v1.0</div>
    <div class="title">Passenger <span>Safety</span></div>
    <div class="subtitle">real-time distress detection system</div>
  </div>

  <div class="orb-wrap">
    <div class="orb" id="orb">
      <div class="orb-ring"></div>
      <div class="orb-icon" id="orbIcon">🛡</div>
      <div class="orb-label" id="orbLabel">ALL CLEAR</div>
      <div class="orb-sub" id="orbSub">monitoring active</div>
    </div>
  </div>

  <div class="meters">
    <div class="meter">
      <div class="meter-head">
        <div class="meter-name">SOUND LEVEL</div>
        <div class="meter-dot" id="soundDot"></div>
      </div>
      <div class="meter-val" id="soundVal">--</div>
      <div class="meter-unit">dB (estimated)</div>
      <div class="meter-bar"><div class="meter-fill" id="soundFill" style="width:0%;background:var(--safe)"></div></div>
    </div>
    <div class="meter">
      <div class="meter-head">
        <div class="meter-name">PULSE (DEMO)</div>
        <div class="meter-dot"></div>
      </div>
      <div class="meter-val" id="pulseVal">72</div>
      <div class="meter-unit">bpm simulated</div>
      <div class="meter-bar"><div class="meter-fill" id="pulseFill" style="width:45%;background:var(--safe)"></div></div>
    </div>
  </div>

  <div class="wave-wrap">
    <div class="wave-head">
      <div class="wave-label">AUDIO WAVEFORM</div>
      <div class="wave-status" id="waveStatus">waiting for mic...</div>
    </div>
    <canvas id="waveCanvas" height="56"></canvas>
  </div>

  <div class="mic-section">
    <button class="mic-btn" id="micBtn" onclick="toggleMic()">
      <div class="mic-dot"></div>
      <span id="micLabel">Enable Microphone</span>
    </button>
  </div>

  <div class="thresholds">
    <div class="thresh-card"><strong>Scream Threshold</strong>&gt; 80 dB estimated RMS amplitude triggers alert</div>
    <div class="thresh-card"><strong>Pulse Threshold</strong>&gt; 120 bpm (demo simulation) triggers alert</div>
    <div class="thresh-card"><strong>Response Window</strong>10 seconds to reply "I am safe"</div>
    <div class="thresh-card"><strong>Auto-SOS</strong>8 seconds after no-response → SOS fires</div>
  </div>

  <div class="log-wrap">
    <div class="log-head">SYSTEM LOG</div>
    <div class="log-inner" id="logInner">
      <div class="log-line ok">[BOOT] SafeRide system initialized</div>
      <div class="log-line">[INFO] Enable microphone to start real detection</div>
    </div>
  </div>

  <div id="safeReplyBtn" class="safe-reply-btn" onclick="iAmSafe()">✓ &nbsp; I am safe — dismiss alert</div>
  <div id="sosBtn" class="sos-btn" onclick="triggerSOS()">🆘 &nbsp; SEND SOS NOW</div>

  <div class="demo-bar">
    <div class="demo-bar-head">DEMO SIMULATOR (no mic needed)</div>
    <div class="demo-btns">
      <button class="demo-btn" onclick="demoScream()">📢 Simulate Scream<br>loud noise &gt; 80dB</button>
      <button class="demo-btn" onclick="demoPulse()">💓 Simulate High Pulse<br>138 bpm elevated</button>
      <button class="demo-btn" onclick="demoBoth()">⚠️ Both Signals<br>combined distress</button>
      <button class="demo-btn reset" onclick="resetAll()">↺ Reset system<br>back to all clear</button>
    </div>
  </div>

  <div class="note">Microphone access stays local — no data is sent anywhere.</div>
</div>

<!-- Safety check modal -->
<div class="modal-bg" id="modalBg">
  <div class="modal">
    <div class="modal-icon">⚠️</div>
    <h2>Are You Safe?</h2>
    <p id="modalMsg">A distress signal was detected. Please confirm you are okay.</p>
    <div class="modal-count" id="modalCount">10</div>
    <button class="btn-yes" onclick="iAmSafe()">Yes, I am safe</button>
    <button class="btn-no" onclick="triggerSOS()">No — Send SOS</button>
  </div>
</div>

<!-- SOS fullscreen -->
<div class="sos-screen" id="sosScreen">
  <div class="big-sos">SOS</div>
  <h3>Emergency Alert Triggered</h3>
  <p>Emergency services have been notified. Your live location is being shared.</p>
  <div class="loc" id="sosLoc">Locating... GPS acquiring</div>
  <p style="font-size:11px;opacity:0.5;font-family:var(--font-mono);margin-bottom:28px">DEMO MODE — no real alert sent</p>
  <button class="cancel" onclick="resetAll()">Cancel (Demo Reset)</button>
</div>

<script>
  // ─── State ───────────────────────────────────────
  let micActive = false;
  let audioCtx = null, analyser = null, micStream = null;
  let animFrame = null;
  let appState = 'safe'; // safe | warn | danger | sos
  let countdownInterval = null;
  let autoSOSTimeout = null;
  let pulseFluctInterval = null;
  let pulseVal = 72;
  let lastScreamTime = 0;
  let screamHoldCount = 0;

  // Scream detection dataset thresholds (normalized 0-255 amplitude values from analyser)
  const SCREAM_RMS_THRESHOLD = 0.18;   // RMS amplitude ratio triggering alert
  const SCREAM_HOLD_FRAMES = 8;        // Must sustain for N frames (~0.3s) to avoid false positives
  const PULSE_HIGH = 120;

  // ─── Microphone ─────────────────────────────────
  async function toggleMic() {
    if (micActive) { stopMic(); return; }
    try {
      const stream = await navigator.mediaDevices.getUserMedia({ audio: true, video: false });
      micStream = stream;
      audioCtx = new (window.AudioContext || window.webkitAudioContext)();
      const source = audioCtx.createMediaStreamSource(stream);
      analyser = audioCtx.createAnalyser();
      analyser.fftSize = 1024;
      analyser.smoothingTimeConstant = 0.6;
      source.connect(analyser);
      micActive = true;
      document.getElementById('micBtn').classList.add('active');
      document.getElementById('micLabel').textContent = 'Mic Active — Scream to Test!';
      document.getElementById('waveStatus').textContent = 'live';
      addLog('Microphone enabled — real-time detection active', 'ok');
      drawLoop();
    } catch(e) {
      addLog('Mic access denied: ' + e.message, 'er');
      alert('Microphone access was denied. Please allow microphone access and try again.');
    }
  }

  function stopMic() {
    micActive = false;
    if (micStream) micStream.getTracks().forEach(t => t.stop());
    if (audioCtx) { audioCtx.close(); audioCtx = null; }
    analyser = null;
    if (animFrame) cancelAnimationFrame(animFrame);
    document.getElementById('micBtn').classList.remove('active');
    document.getElementById('micLabel').textContent = 'Enable Microphone';
    document.getElementById('waveStatus').textContent = 'stopped';
    document.getElementById('soundVal').textContent = '--';
    addLog('Microphone disabled', '');
  }

  // ─── Draw / Detect Loop ──────────────────────────
  function drawLoop() {
    if (!micActive || !analyser) return;
    animFrame = requestAnimationFrame(drawLoop);

    const bufLen = analyser.frequencyBinCount;
    const timeData = new Uint8Array(bufLen);
    const freqData = new Uint8Array(bufLen);
    analyser.getByteTimeDomainData(timeData);
    analyser.getByteFrequencyData(freqData);

    // RMS amplitude
    let sumSq = 0;
    for (let i = 0; i < bufLen; i++) {
      const norm = (timeData[i] - 128) / 128;
      sumSq += norm * norm;
    }
    const rms = Math.sqrt(sumSq / bufLen);

    // Estimate dB
    const dB = rms > 0 ? Math.round(20 * Math.log10(rms) + 90) : 0;
    const dBClamped = Math.max(0, Math.min(120, dB));
    document.getElementById('soundVal').textContent = dBClamped;

    // Bar color
    const pct = Math.min(100, (dBClamped / 100) * 100);
    const color = dBClamped > 75 ? '#ff4455' : dBClamped > 55 ? '#f0a040' : '#00d4a0';
    document.getElementById('soundFill').style.width = pct + '%';
    document.getElementById('soundFill').style.background = color;

    // Scream detection
    if (rms > SCREAM_RMS_THRESHOLD) {
      screamHoldCount++;
      if (screamHoldCount >= SCREAM_HOLD_FRAMES && appState === 'safe') {
        onScreamDetected(dBClamped);
      }
    } else {
      screamHoldCount = Math.max(0, screamHoldCount - 1);
    }

    // Waveform
    drawWave(timeData);
  }

  function drawWave(data) {
    const canvas = document.getElementById('waveCanvas');
    const ctx = canvas.getContext('2d');
    canvas.width = canvas.offsetWidth;
    const W = canvas.width, H = canvas.height;
    ctx.clearRect(0, 0, W, H);

    const waveColor = appState === 'sos' || appState === 'danger' ? '#ff4455' :
                      appState === 'warn' ? '#f0a040' : '#00d4a0';
    ctx.strokeStyle = waveColor;
    ctx.lineWidth = 1.5;
    ctx.shadowColor = waveColor;
    ctx.shadowBlur = 4;
    ctx.beginPath();
    const sliceW = W / data.length;
    let x = 0;
    for (let i = 0; i < data.length; i++) {
      const v = data[i] / 128;
      const y = (v * H) / 2;
      i === 0 ? ctx.moveTo(x, y) : ctx.lineTo(x, y);
      x += sliceW;
    }
    ctx.stroke();
  }

  // ─── Scream Detection ────────────────────────────
  function onScreamDetected(db) {
    screamHoldCount = 0;
    lastScreamTime = Date.now();
    addLog('SCREAM DETECTED — ' + db + ' dB — initiating safety check', 'er');
    startAlert('Screaming or loud distress detected at ' + db + ' dB.');
  }

  // ─── Pulse simulation ────────────────────────────
  function startPulseFluctuation(base, range) {
    clearInterval(pulseFluctInterval);
    pulseFluctInterval = setInterval(() => {
      pulseVal = base + Math.round((Math.random() - 0.5) * range * 2);
      document.getElementById('pulseVal').textContent = pulseVal;
      const pct = Math.min(100, ((pulseVal - 40) / 160) * 100);
      const col = pulseVal > PULSE_HIGH ? '#ff4455' : pulseVal > 100 ? '#f0a040' : '#00d4a0';
      document.getElementById('pulseFill').style.width = pct + '%';
      document.getElementById('pulseFill').style.background = col;
    }, 700);
  }

  // ─── Alert / Modal Flow ──────────────────────────
  function startAlert(reason) {
    if (appState !== 'safe') return;
    setAppState('warn');
    document.getElementById('modalMsg').textContent = reason + ' Please confirm you are okay.';
    document.getElementById('modalBg').classList.add('visible');
    let count = 10;
    document.getElementById('modalCount').textContent = count;
    countdownInterval = setInterval(() => {
      count--;
      document.getElementById('modalCount').textContent = count;
      if (count <= 0) {
        clearInterval(countdownInterval);
        document.getElementById('modalBg').classList.remove('visible');
        noResponse();
      }
    }, 1000);
  }

  function noResponse() {
    setAppState('danger');
    addLog('NO RESPONSE from passenger — SOS button activated', 'er');
    document.getElementById('sosBtn').classList.add('visible');
    document.getElementById('safeReplyBtn').classList.add('visible');
    let autoCount = 8;
    addLog('Auto-SOS in ' + autoCount + 's if no action...', 'wn');
    autoSOSTimeout = setInterval(() => {
      autoCount--;
      if (autoCount <= 0) { clearInterval(autoSOSTimeout); triggerSOS(); }
    }, 1000);
  }

  function iAmSafe() {
    clearInterval(countdownInterval);
    clearInterval(autoSOSTimeout);
    document.getElementById('modalBg').classList.remove('visible');
    document.getElementById('sosBtn').classList.remove('visible');
    document.getElementById('safeReplyBtn').classList.remove('visible');
    screamHoldCount = 0;
    setAppState('safe');
    startPulseFluctuation(72, 4);
    document.getElementById('soundFill').style.background = '#00d4a0';
    addLog('Passenger confirmed safe — alert cleared', 'ok');
  }

  function triggerSOS() {
    clearInterval(countdownInterval);
    clearInterval(autoSOSTimeout);
    clearInterval(pulseFluctInterval);
    document.getElementById('modalBg').classList.remove('visible');
    setAppState('sos');
    addLog('🆘 SOS TRIGGERED — emergency services notified', 'er');
    addLog('Live location sharing enabled', 'er');
    document.getElementById('sosScreen').classList.add('visible');
    // Fake GPS
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(pos => {
        document.getElementById('sosLoc').textContent =
          'GPS: ' + pos.coords.latitude.toFixed(4) + ', ' + pos.coords.longitude.toFixed(4);
      }, () => {
        document.getElementById('sosLoc').textContent = 'GPS: location unavailable (demo)';
      });
    }
  }

  // ─── Demo Simulators ────────────────────────────
  function demoScream() {
    if (appState !== 'safe') return;
    addLog('DEMO: Scream simulated — 94 dB', 'er');
    document.getElementById('soundVal').textContent = 94;
    document.getElementById('soundFill').style.width = '94%';
    document.getElementById('soundFill').style.background = '#ff4455';
    startPulseFluctuation(88, 8);
    startAlert('Demo: Loud scream detected at 94 dB.');
  }

  function demoPulse() {
    if (appState !== 'safe') return;
    addLog('DEMO: High pulse simulated — 138 bpm', 'wn');
    startPulseFluctuation(138, 10);
    startAlert('Demo: Elevated pulse rate detected at 138 bpm.');
  }

  function demoBoth() {
    if (appState !== 'safe') return;
    addLog('DEMO: Both signals — 102 dB + 145 bpm', 'er');
    document.getElementById('soundVal').textContent = 102;
    document.getElementById('soundFill').style.width = '100%';
    document.getElementById('soundFill').style.background = '#ff4455';
    startPulseFluctuation(145, 8);
    document.getElementById('modalMsg').textContent = 'Both scream (102 dB) and high pulse (145 bpm) detected simultaneously.';
    document.getElementById('modalBg').classList.add('visible');
    setAppState('warn');
    let count = 7;
    document.getElementById('modalCount').textContent = count;
    countdownInterval = setInterval(() => {
      count--;
      document.getElementById('modalCount').textContent = count;
      if (count <= 0) { clearInterval(countdownInterval); document.getElementById('modalBg').classList.remove('visible'); noResponse(); }
    }, 1000);
  }

  function resetAll() {
    clearInterval(countdownInterval);
    clearInterval(autoSOSTimeout);
    screamHoldCount = 0;
    document.getElementById('modalBg').classList.remove('visible');
    document.getElementById('sosScreen').classList.remove('visible');
    document.getElementById('sosBtn').classList.remove('visible');
    document.getElementById('safeReplyBtn').classList.remove('visible');
    setAppState('safe');
    startPulseFluctuation(72, 4);
    document.getElementById('soundVal').textContent = micActive ? document.getElementById('soundVal').textContent : '--';
    document.getElementById('soundFill').style.width = '5%';
    document.getElementById('soundFill').style.background = '#00d4a0';
    addLog('System reset — monitoring resumed', 'ok');
  }

  // ─── UI State ────────────────────────────────────
  function setAppState(s) {
    appState = s;
    const orb = document.getElementById('orb');
    const icon = document.getElementById('orbIcon');
    const label = document.getElementById('orbLabel');
    const sub = document.getElementById('orbSub');
    orb.className = 'orb ' + (s === 'safe' ? '' : s);
    document.body.className = s === 'safe' ? '' : 'state-' + (s === 'sos' ? 'danger' : s);
    if (s === 'safe')   { icon.textContent='🛡'; label.textContent='ALL CLEAR'; sub.textContent='monitoring active'; }
    if (s === 'warn')   { icon.textContent='⚠️'; label.textContent='ALERT'; sub.textContent='distress detected'; }
    if (s === 'danger') { icon.textContent='!!'; label.textContent='NO RESPONSE'; sub.textContent='sos ready'; }
    if (s === 'sos')    { icon.textContent='🆘'; label.textContent='SOS ACTIVE'; sub.textContent='help is coming'; }
  }

  // ─── Log ─────────────────────────────────────────
  function addLog(msg, type) {
    const el = document.getElementById('logInner');
    const line = document.createElement('div');
    line.className = 'log-line ' + (type || '');
    const now = new Date();
    const ts = now.getHours().toString().padStart(2,'0') + ':' +
               now.getMinutes().toString().padStart(2,'0') + ':' +
               now.getSeconds().toString().padStart(2,'0');
    line.textContent = '[' + ts + '] ' + msg;
    el.insertBefore(line, el.firstChild);
    while (el.children.length > 10) el.removeChild(el.lastChild);
  }

  // ─── Init ────────────────────────────────────────
  startPulseFluctuation(72, 4);

  // Draw idle waveform
  (function idleWave() {
    if (micActive) return;
    const canvas = document.getElementById('waveCanvas');
    const ctx = canvas.getContext('2d');
    canvas.width = canvas.offsetWidth || 400;
    const W = canvas.width, H = canvas.height;
    ctx.clearRect(0, 0, W, H);
    ctx.strokeStyle = 'rgba(0,212,160,0.15)';
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    for (let x = 0; x < W; x++) {
      const y = H/2 + Math.sin(x * 0.04 + Date.now() * 0.002) * 4;
      x === 0 ? ctx.moveTo(x,y) : ctx.lineTo(x,y);
    }
    ctx.stroke();
    requestAnimationFrame(idleWave);
  })();
</script>
</body>
</html>