<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — OTIV DIANA</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="./icon/fontAwesome/all.min.css">
</head>
<body>

<div class="login-wrapper-custom">
    <div class="login-card-custom">
        <!-- Logo et titre -->
        <div class="login-header-custom">
            <div class="login-logo-custom">
                <img src="icon/sans-fond.png" alt="OTIV Logo">
            </div>
            <h1 class="login-title-custom">OTIV <span>DIANA</span></h1>
            <p class="login-subtitle-custom">Connectez-vous à votre espace documentaire</p>
        </div>
        
        <!-- Message d'erreur (affiché dynamiquement par le JS) -->
        <div id="errorBox" class="login-error-custom" style="display: none;">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span id="errorText">Identifiants incorrects</span>
        </div>
        
        <!-- Formulaire -->
        <form id="formLogin" autocomplete="off">
            <div class="form-group-custom">
                <label for="user">
                    Nom d'utilisateur ou Email <span class="required">*</span>
                </label>
                <div class="input-wrapper-custom">
                    <i class="fa-regular fa-user input-icon"></i>
                    <input type="text" 
                           id="user" 
                           name="user" 
                           placeholder="Entrez votre nom ou email" 
                           required
                           autofocus>
                </div>
            </div>
            
            <div class="form-group-custom">
                <label for="password">
                    Mot de passe <span class="required">*</span>
                </label>
                <div class="input-wrapper-custom">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           placeholder="Entrez votre mot de passe"
                           required>
                    <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Afficher le mot de passe">
                        <i class="fa-regular fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>
            
            <button type="submit" id="btnSubmit" class="btn-login-custom">
                <i class="fa-solid fa-right-to-bracket"></i>
                Se connecter
            </button>
        </form>
    </div>
</div>

<script>
    // 1. Afficher / Cacher le mot de passe
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.className = 'fa-regular fa-eye-slash';
        } else {
            passwordInput.type = 'password';
            toggleIcon.className = 'fa-regular fa-eye';
        }
    }

    // 2. Gestion de la connexion avec le Backend Laravel
    document.getElementById('formLogin').addEventListener('submit', async function(e) {
        e.preventDefault();

        const userInput = document.getElementById('user').value.trim();
        const passwordInput = document.getElementById('password').value;
        const errorBox = document.getElementById('errorBox');
        const errorText = document.getElementById('errorText');
        const btnSubmit = document.getElementById('btnSubmit');

        errorBox.style.display = 'none';
        btnSubmit.disabled = true;
        btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Connexion...';

        try {
            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    user: userInput,
                    password: passwordInput
                })
            });

            const data = await response.json();

            if (response.ok && data.status === 'success') {
                // Stocker les données de l'utilisateur connecté dans le navigateur
                localStorage.setItem('currentUser', JSON.stringify(data.user));

                // Redirection automatique (vers accueil.html ou admin_dashboard.html)
                window.location.href = data.redirect_url;
            } else {
                errorBox.style.display = 'flex';
                errorText.innerText = data.message || "Identifiants invalides";
            }
        } catch (err) {
            errorBox.style.display = 'flex';
            errorText.innerText = "Erreur : Impossible de joindre le serveur.";
        } finally {
            btnSubmit.disabled = false;
            btnSubmit.innerHTML = '<i class="fa-solid fa-right-to-bracket"></i> Se connecter';
        }
    });
</script>

</body>
</html>