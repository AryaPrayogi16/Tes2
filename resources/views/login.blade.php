<!DOCTYPE html>
<html>
<head>
    <title>Login Multi-Role</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div style="min-height: 100vh; background: #f3f4f6; display: flex; align-items: center; justify-content: center; padding: 2rem; font-family: sans-serif;">
  <div style="width: 100%; max-width: 400px;">

    <div style="text-align: center; margin-bottom: 2rem;">
      <div style="width: 52px; height: 52px; border-radius: 14px; background: #378ADD; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
        </svg>
      </div>
      <h1 style="font-size: 22px; font-weight: 500; color: #111; margin: 0 0 6px;">Masuk ke Sistem</h1>
      <p style="font-size: 13px; color: #6b7280; margin: 0;">Masukkan kredensial Anda untuk melanjutkan</p>
    </div>

    <div style="background: #fff; border-radius: 12px; border: 0.5px solid #e5e7eb; padding: 2rem;">

      <div id="errorBanner" style="display:none; background: #fef2f2; border: 0.5px solid #fca5a5; border-radius: 8px; padding: 10px 14px; margin-bottom: 1.25rem; align-items: center; gap: 8px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
          <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        <span id="errorMsg" style="font-size: 13px; color: #dc2626;"></span>
      </div>

      <div style="margin-bottom: 1.25rem;">
        <label style="display: block; font-size: 12px; font-weight: 500; color: #6b7280; margin-bottom: 6px; letter-spacing: 0.04em;">EMAIL</label>
        <div style="position: relative;">
          <svg style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; pointer-events:none;" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
          </svg>
          <input id="email" type="email" placeholder="nama@perusahaan.com" autocomplete="email"
            style="width:100%; box-sizing:border-box; padding: 10px 12px 10px 40px; font-size: 14px; border-radius: 8px; border: 0.5px solid #d1d5db; background: #f9fafb; color: #111; outline: none;"
            onfocus="this.style.borderColor='#378ADD';this.style.boxShadow='0 0 0 3px rgba(55,138,221,0.12)'"
            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow=''">
        </div>
      </div>

      <div style="margin-bottom: 1.75rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
          <label style="font-size: 12px; font-weight: 500; color: #6b7280; letter-spacing: 0.04em;">PASSWORD</label>
          <a href="#" style="font-size: 12px; color: #378ADD; text-decoration: none;">Lupa password?</a>
        </div>
        <div style="position: relative;">
          <svg style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; pointer-events:none;" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect width="18" height="11" x="3" y="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
          <input id="password" type="password" placeholder="••••••••" autocomplete="current-password"
            style="width:100%; box-sizing:border-box; padding: 10px 40px 10px 40px; font-size: 14px; border-radius: 8px; border: 0.5px solid #d1d5db; background: #f9fafb; color: #111; outline: none;"
            onfocus="this.style.borderColor='#378ADD';this.style.boxShadow='0 0 0 3px rgba(55,138,221,0.12)'"
            onblur="this.style.borderColor='#d1d5db';this.style.boxShadow=''">
          <button type="button" onclick="togglePwd()" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; padding:0; color:#9ca3af;">
            <svg id="eyeIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/>
            </svg>
          </button>
        </div>
      </div>

      <button id="loginBtn" onclick="handleLogin()" type="button"
        style="width:100%; padding: 11px; font-size: 14px; font-weight: 500; background: #378ADD; color: white; border: none; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.15s;"
        onmouseover="if(!this.disabled)this.style.background='#185FA5'"
        onmouseout="if(!this.disabled)this.style.background='#378ADD'">
        <span id="btnText">Masuk</span>
        <svg id="btnIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
        <svg id="spinIcon" style="display:none; animation: spin 0.8s linear infinite;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
        </svg>
      </button>

    </div>

    <p style="text-align:center; font-size: 12px; color: #9ca3af; margin-top: 1.5rem;">
      &copy; 2025 Sistem Login Multi-Role
    </p>
  </div>
</div>

<style>
@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>

<script>
function togglePwd() {
  const p = document.getElementById('password');
  const icon = document.getElementById('eyeIcon');
  if (p.type === 'password') {
    p.type = 'text';
    icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>';
  } else {
    p.type = 'password';
    icon.innerHTML = '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/>';
  }
}

function showError(msg) {
  const b = document.getElementById('errorBanner');
  b.style.display = 'flex';
  document.getElementById('errorMsg').innerText = msg;
}

function hideError() {
  document.getElementById('errorBanner').style.display = 'none';
}

function setLoading(loading) {
  const btn = document.getElementById('loginBtn');
  const btnText = document.getElementById('btnText');
  const btnIcon = document.getElementById('btnIcon');
  const spinIcon = document.getElementById('spinIcon');
  btn.disabled = loading;
  btn.style.opacity = loading ? '0.75' : '1';
  btnText.innerText = loading ? 'Memproses...' : 'Masuk';
  btnIcon.style.display = loading ? 'none' : '';
  spinIcon.style.display = loading ? '' : 'none';
}

async function handleLogin() {
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value;
  hideError();

  if (!email || !password) {
    showError('Email dan password wajib diisi.');
    return;
  }

  setLoading(true);
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
    const response = await fetch('/login-api', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({ email, password })
    });

    const result = await response.json();

    if (response.ok) {
      if (result.redirect_to) {
        window.location.href = result.redirect_to;
      } else {
        showError('Berhasil login, tapi URL tujuan tidak ditemukan.');
      }
    } else {
      showError(result.message || 'Email atau password salah!');
    }
  } catch (error) {
    console.error(error);
    showError('Terjadi kesalahan sistem. Periksa koneksi Anda.');
  } finally {
    setLoading(false);
  }
}

document.addEventListener('keydown', e => { if (e.key === 'Enter') handleLogin(); });
</script>

</body>
</html>