// Validação para o formulário de registro
function validateRegisterForm(event) {
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirm_password').value.trim();

    // Nome de usuário: mínimo 3 caracteres, sem caracteres especiais
    if (!/^[a-zA-Z0-9]{3,}$/.test(username)) {
        alert('O nome de usuário deve ter pelo menos 3 caracteres e não conter caracteres especiais.');
        event.preventDefault();
        return;
    }

    // Email: validação com regex
    if (!/^\S+@\S+\.\S+$/.test(email)) {
        alert('Por favor, insira um e-mail válido.');
        event.preventDefault();
        return;
    }

    // Senha: pelo menos 8 caracteres, uma letra maiúscula, um número e um caractere especial
    if (!/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
        alert('A senha deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula, um número e um caractere especial.');
        event.preventDefault();
        return;
    }

    // Confirmação de senha: deve corresponder à senha
    if (password !== confirmPassword) {
        alert('As senhas não correspondem.');
        event.preventDefault();
        return;
    }
}

// Validação para o formulário de login
function validateLoginForm(event) {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();

    // Nome de usuário ou email: não vazio
    if (email.length === 0) {
        alert('Por favor, insira seu nome de usuário ou e-mail.');
        event.preventDefault();
        return;
    }

    // Senha: não vazio
    if (password.length === 0) {
        alert('Por favor, insira sua senha.');
        event.preventDefault();
        return;
    }
}

// Associa os validadores aos formulários
document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', validateRegisterForm);
    }

    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', validateLoginForm);
    }
});
