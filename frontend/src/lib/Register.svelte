<script>
    let name = "";
    let email = "";
    let password = "";
    let errors = {
        name: "",
        email: "",
        password: "",
    };
    let touched = {
        name: false,
        email: false,
        password: false,
    };
    let submitted = false;

    function validateName(value) {
        if (!value) {
            return "Имя обязательно";
        }
        if (value.length < 2) {
            return "Имя должно содержать минимум 2 символа";
        }
        return "";
    }

    function validateEmail(value) {
        if (!value) {
            return "Email обязателен";
        }
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            return "Введите корректный email";
        }
        return "";
    }

    function validatePassword(value) {
        if (!value) {
            return "Пароль обязателен";
        }
        if (value.length < 8) {
            return "Пароль должен содержать минимум 8 символов";
        }
        return "";
    }

    function handleBlur(field) {
        touched[field] = true;
        if (field === "name") {
            errors.name = validateName(name);
        } else if (field === "email") {
            errors.email = validateEmail(email);
        } else if (field === "password") {
            errors.password = validatePassword(password);
        }
    }

    function handleSubmit() {
        submitted = true;
        touched.name = true;
        touched.email = true;
        touched.password = true;

        errors.name = validateName(name);
        errors.email = validateEmail(email);
        errors.password = validatePassword(password);

        if (!errors.name && !errors.email && !errors.password) {
            // TODO: Implement registration logic
            console.log("Registration attempt:", { name, email, password });
        }
    }

    $: if (submitted || touched.name) {
        errors.name = validateName(name);
    }
    $: if (submitted || touched.email) {
        errors.email = validateEmail(email);
    }
    $: if (submitted || touched.password) {
        errors.password = validatePassword(password);
    }
</script>

<div class="auth-page">
    <div class="container">
        <div class="auth-card">
            <a href="/" class="back-link">← На главную</a>
            <h1>Регистрация</h1>
            <p class="subtitle">
                Создайте аккаунт, чтобы начать отслеживать свои тренировки.
            </p>

            <form on:submit|preventDefault={handleSubmit} novalidate>
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input
                        type="text"
                        id="name"
                        bind:value={name}
                        on:blur={() => handleBlur("name")}
                        class:error={errors.name && (touched.name || submitted)}
                        placeholder="Иван Иванов"
                    />
                    {#if errors.name && (touched.name || submitted)}
                        <span class="error-message">{errors.name}</span>
                    {/if}
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        bind:value={email}
                        on:blur={() => handleBlur("email")}
                        class:error={errors.email &&
                            (touched.email || submitted)}
                        placeholder="name@example.com"
                    />
                    {#if errors.email && (touched.email || submitted)}
                        <span class="error-message">{errors.email}</span>
                    {/if}
                </div>

                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input
                        type="password"
                        id="password"
                        bind:value={password}
                        on:blur={() => handleBlur("password")}
                        class:error={errors.password &&
                            (touched.password || submitted)}
                        placeholder="••••••••"
                    />
                    {#if errors.password && (touched.password || submitted)}
                        <span class="error-message">{errors.password}</span>
                    {/if}
                </div>

                <button type="submit" class="btn-submit"
                    >Зарегистрироваться</button
                >
            </form>

            <p class="footer-text">
                Уже есть аккаунт? <a href="/login">Войти</a>
            </p>
        </div>
    </div>
</div>

<style>
    .auth-page {
        min-height: calc(100vh - 64px); /* Subtract header height */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 0;
        background-color: var(--slate-50);
    }

    .auth-card {
        background: white;
        padding: 2.5rem;
        border-radius: 1rem;
        box-shadow:
            0 4px 6px -1px rgba(0, 0, 0, 0.1),
            0 2px 4px -1px rgba(0, 0, 0, 0.06);
        width: 100%;
        max-width: 480px;
        margin: 0 auto;
        border: 1px solid var(--slate-200);
    }

    h1 {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--slate-900);
        margin: 0 0 0.5rem 0;
        text-align: center;
    }

    .subtitle {
        color: var(--slate-600);
        text-align: center;
        margin-bottom: 2rem;
        font-size: 1rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--slate-700);
        margin-bottom: 0.5rem;
    }

    input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--slate-300);
        border-radius: 0.5rem;
        font-size: 1rem;
        color: var(--slate-900);
        transition:
            border-color 0.2s,
            box-shadow 0.2s;
    }

    input:focus {
        outline: none;
        border-color: var(--primary-500);
        box-shadow: 0 0 0 3px var(--primary-100);
    }

    input.error {
        border-color: #ef4444;
    }

    input.error:focus {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .error-message {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #ef4444;
        animation: slideDown 0.2s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-4px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .btn-submit {
        width: 100%;
        padding: 0.75rem;
        background-color: var(--primary-600);
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
        margin-top: 0.5rem;
    }

    .btn-submit:hover {
        background-color: var(--primary-700);
    }

    .footer-text {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 0.875rem;
        color: var(--slate-600);
    }

    .footer-text a {
        color: var(--primary-600);
        font-weight: 500;
    }

    .footer-text a:hover {
        text-decoration: underline;
    }

    .back-link {
        display: inline-block;
        color: var(--slate-600);
        font-size: 0.875rem;
        margin-bottom: 1rem;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: var(--primary-600);
    }
</style>
