<script>
    let isMobileMenuOpen = false;

    function toggleMobileMenu() {
        isMobileMenuOpen = !isMobileMenuOpen;
    }
</script>

<header>
    <div class="container">
        <div class="header-content">
            <div class="left-section">
                <a href="/" class="logo">RunTracker</a>

                <nav class="desktop-nav">
                    <a href="#features">Возможности</a>
                    <a href="#how">Как работает</a>
                    <a href="#faq">FAQ</a>
                </nav>
            </div>

            <div class="right-section">
                <a href="/login" class="btn-login">Вход</a>
                <a href="/register" class="btn-register">Регистрация</a>

                <button
                    class="mobile-menu-btn"
                    on:click={toggleMobileMenu}
                    aria-label="Меню"
                >
                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {#if isMobileMenuOpen}
        <div class="mobile-menu">
            <div class="container">
                <nav>
                    <a href="#features" on:click={toggleMobileMenu}
                        >Возможности</a
                    >
                    <a href="#how" on:click={toggleMobileMenu}>Как работает</a>
                    <a href="#faq" on:click={toggleMobileMenu}>FAQ</a>
                    <div class="mobile-auth">
                        <a
                            href="/login"
                            class="mobile-btn-login"
                            on:click={toggleMobileMenu}>Вход</a
                        >
                        <a
                            href="/register"
                            class="mobile-btn-register"
                            on:click={toggleMobileMenu}>Регистрация</a
                        >
                    </div>
                </nav>
            </div>
        </div>
    {/if}
</header>

<style>
    header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 50;
        background-color: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(8px);
        border-bottom: 1px solid rgba(226, 232, 240, 0.5); /* slate-200/50 */
        height: 64px;
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 64px;
    }

    .left-section,
    .right-section {
        display: flex;
        align-items: center;
    }

    .logo {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--slate-900);
        margin-right: 2rem;
        border-radius: 0.25rem;
    }

    .desktop-nav {
        display: none;
    }

    .desktop-nav a {
        font-size: 0.875rem;
        color: var(--slate-700);
        padding: 0.5rem 0.75rem;
        border-radius: 0.25rem;
        transition: color 0.2s;
    }

    .desktop-nav a:hover {
        color: var(--slate-900);
    }

    .btn-login {
        display: none; /* Hidden on mobile */
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        color: var(--slate-800);
        background-color: var(--slate-100);
        border-radius: 0.5rem;
        margin-right: 0.75rem;
        transition: background-color 0.2s;
    }

    .btn-login:hover {
        background-color: var(--slate-200);
    }

    .btn-register {
        display: none; /* Hidden on mobile */
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        color: white;
        background-color: var(--primary-600);
        border-radius: 0.5rem;
        transition: background-color 0.2s;
    }

    .btn-register:hover {
        background-color: var(--primary-700);
    }

    .mobile-menu-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem;
        border: none;
        background: none;
        color: var(--slate-700);
        cursor: pointer;
        margin-left: 0.5rem;
    }

    .mobile-menu {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        border-top: 1px solid rgba(226, 232, 240, 0.5);
        padding: 0.75rem 0;
    }

    .mobile-menu nav {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .mobile-menu a {
        padding: 0.5rem 0.75rem;
        color: var(--slate-700);
        border-radius: 0.25rem;
    }

    .mobile-menu a:hover {
        color: var(--slate-900);
        background-color: var(--slate-50);
    }

    .mobile-auth {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px solid var(--slate-200);
    }

    .mobile-btn-login {
        text-align: center;
        background-color: var(--slate-100);
        color: var(--slate-800) !important;
    }

    .mobile-btn-register {
        text-align: center;
        background-color: var(--primary-600);
        color: white !important;
    }

    @media (min-width: 768px) {
        .desktop-nav {
            display: flex;
            gap: 0.5rem;
        }

        .btn-login,
        .btn-register {
            display: inline-flex; /* Show on desktop */
        }

        .mobile-menu-btn {
            display: none;
        }
    }
</style>
