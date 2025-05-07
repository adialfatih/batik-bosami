<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Batik Bosami</title>
    <style>
        .container{width:100%;height:100vh;display:flex;flex-direction:column;justify-content:center;align-items:center}.modern-form{--primary:#3b82f6;--primary-dark:#2563eb;--primary-light:rgba(59, 130, 246, 0.1);--success:#10b981;--text-main:#1e293b;--text-secondary:#64748b;--bg-input:#f8fafc;position:relative;width:300px;padding:24px;background:#fff;border-radius:16px;box-shadow:0 4px 6px -1px rgba(0,0,0,.1),0 2px 4px -2px rgba(0,0,0,.05),inset 0 0 0 1px rgba(148,163,184,.1);font-family:system-ui,-apple-system,sans-serif}.form-title{font-size:22px;font-weight:600;color:var(--text-main);margin:0 0 24px;text-align:center;letter-spacing:-.01em}.input-group{margin-bottom:16px}.input-wrapper{position:relative;display:flex;align-items:center}.form-input{width:100%;height:40px;padding:0 36px;font-size:14px;border:1px solid #e2e8f0;border-radius:10px;background:var(--bg-input);color:var(--text-main);transition:.2s}.eye-icon,.input-icon{width:16px;height:16px}.password-toggle,.submit-button{border:none;cursor:pointer;transition:.2s}.input-icon,.password-toggle{position:absolute;color:var(--text-secondary)}.form-input::placeholder{color:var(--text-secondary)}.input-icon{left:12px;pointer-events:none}.password-toggle{right:12px;display:flex;align-items:center;padding:4px;background:0 0}.submit-button{position:relative;width:100%;height:40px;margin-top:8px;background:var(--primary);color:#fff;border-radius:10px;font-size:14px;font-weight:500;overflow:hidden}.button-glow{position:absolute;inset:0;background:linear-gradient(90deg,transparent,rgba(255,255,255,.2),transparent);transform:translateX(-100%);transition:transform .5s}.form-footer{margin-top:16px;text-align:center;font-size:13px}.login-link{color:var(--text-secondary);text-decoration:none;transition:.2s}.login-link span{color:var(--primary);font-weight:500}.form-input:hover{border-color:#cbd5e1}.form-input:focus{outline:0;border-color:var(--primary);background:#fff;box-shadow:0 0 0 4px var(--primary-light)}.password-toggle:hover{color:var(--primary);transform:scale(1.1)}.submit-button:hover{background:var(--primary-dark);transform:translateY(-1px);box-shadow:0 4px 12px rgba(59,130,246,.25),0 2px 4px rgba(59,130,246,.15)}.submit-button:hover .button-glow{transform:translateX(100%)}.login-link:hover{color:var(--text-main)}.login-link:hover span{color:var(--primary-dark)}.submit-button:active{transform:translateY(0);box-shadow:none}.password-toggle:active{transform:scale(.9)}.form-input:not(:placeholder-shown):valid{border-color:var(--success)}.form-input:not(:placeholder-shown):valid~.input-icon{color:var(--success)}@keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-4px)}75%{transform:translateX(4px)}}.form-input:not(:placeholder-shown):invalid{border-color:#ef4444;animation:.2s ease-in-out shake}.form-input:not(:placeholder-shown):invalid~.input-icon{color:#ef4444}
    </style>
</head>
<body>
    <div class="container">
        <form class="modern-form" action="<?=base_url('login/proses_login');?>" method="post">
            <div class="form-title">Sign In</div>
                <div class="form-body">
                    <div class="input-group">
                        <div class="input-wrapper">
                            <svg fill="none" viewBox="0 0 24 24" class="input-icon">
                            <circle stroke-width="1.5" stroke="currentColor" r="4" cy="8" cx="12"></circle>
                            <path stroke-linecap="round" stroke-width="1.5" stroke="currentColor" d="M5 20C5 17.2386 8.13401 15 12 15C15.866 15 19 17.2386 19 20"></path>
                            </svg>
                            <input required="" name="username" placeholder="Username" class="form-input" type="text" />
                        </div>
                    </div>
    <!-- <div class="input-group">
      <div class="input-wrapper">
        <svg fill="none" viewBox="0 0 24 24" class="input-icon">
          <path
            stroke-width="1.5"
            stroke="currentColor"
            d="M3 8L10.8906 13.2604C11.5624 13.7083 12.4376 13.7083 13.1094 13.2604L21 8M5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19Z"
          ></path>
        </svg>
        <input
          required=""
          placeholder="Email"
          class="form-input"
          type="email"
        />
      </div>
    </div> -->

                    <div class="input-group">
                        <div class="input-wrapper">
                            <svg fill="none" viewBox="0 0 24 24" class="input-icon">
                            <path stroke-width="1.5" stroke="currentColor" d="M12 10V14M8 6H16C17.1046 6 18 6.89543 18 8V16C18 17.1046 17.1046 18 16 18H8C6.89543 18 6 17.1046 6 16V8C6 6.89543 6.89543 6 8 6Z"></path>
                            </svg>
                            <input required="" name="password" placeholder="Password" class="form-input" type="password" id="passwordid" />
                            <button class="password-toggle" type="button" onclick="togglePassword()">
                            <svg fill="none" viewBox="0 0 24 24" class="eye-icon">
                                <path stroke-width="1.5" stroke="currentColor" d="M2 12C2 12 5 5 12 5C19 5 22 12 22 12C22 12 19 19 12 19C5 19 2 12 2 12Z"></path>
                                <circle stroke-width="1.5" stroke="currentColor" r="3" cy="12" cx="12"></circle>
                            </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <?php if ($this->session->flashdata('message')): ?>
                    <p style="color:red;font-size:14px;text-align:center"><?= $this->session->flashdata('message'); ?></p>
                <?php endif; ?>
                <button class="submit-button" type="submit">
                    <span class="button-text">LOGIN</span>
                    <div class="button-glow"></div>
                </button>

                <div class="form-footer">
                    <a class="login-link" href="#">
                    &copy; 2025 Batik Bosami By <a href="https://grafamedia.com" target="_blank" style="text-decoration: none;color:#4b89eb;font-weight:bold;"><span>GRAFAMEDIA</span></a>
                    </a>
                </div>
        </form>

    </div>
    <script>function togglePassword(){var passwordInput=document.getElementById("passwordid");if(passwordInput.type==="password"){passwordInput.type="text"}else{passwordInput.type="password"}}</script>
</body>
</html>