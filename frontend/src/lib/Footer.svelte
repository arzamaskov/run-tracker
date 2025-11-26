<script>
    const year = new Date().getFullYear();
</script>

<footer>
    <div class="container">
        <div class="grid">
            <div class="col">
                <div class="brand">RunTracker</div>
                <p class="slogan">Умные тренировки. Уверенный прогресс.</p>
            </div>

            <div class="col">
                <div class="label">Технологии</div>
                <p class="tech">Symfony 7 • Svelte 5 • Vite</p>
            </div>

            <div class="col">
                <div class="label">Правовая информация</div>
                <nav>
                    <a href="#privacy">Политика конфиденциальности</a>
                    <a href="#terms">Условия использования</a>
                </nav>
            </div>
        </div>

        <div class="copyright">
            <p>&copy; {year} RunTracker. Все права защищены.</p>
            <a
                href="https://github.com/arzamaskov"
                target="_blank"
                rel="noopener noreferrer"
                class="author-link"
            >
                <span>Created by arzamaskov</span>
                <svg
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <path
                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"
                    />
                </svg>
            </a>
        </div>
    </div>
</footer>

<style>
    footer {
        background-color: var(--slate-50);
        border-top: 1px solid var(--slate-200);
        padding: 3rem 0;
    }

    .grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .brand {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--slate-900);
        margin-bottom: 0.5rem;
    }

    .slogan {
        font-size: 0.875rem;
        color: var(--slate-600);
    }

    .label {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--slate-900);
        margin-bottom: 0.5rem;
    }

    .tech {
        font-size: 0.875rem;
        color: var(--slate-600);
    }

    nav {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    nav a {
        font-size: 0.875rem;
        color: var(--slate-600);
        transition: color 0.2s;
    }

    nav a:hover {
        color: var(--slate-900);
    }

    .copyright {
        border-top: 1px solid var(--slate-200);
        padding-top: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }

    .copyright p {
        font-size: 0.875rem;
        color: var(--slate-500);
    }

    .author-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--slate-600);
        transition: color 0.2s;
        text-decoration: none;
    }

    .author-link:hover {
        color: var(--slate-900);
    }

    @media (min-width: 768px) {
        .grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .copyright {
            flex-direction: row;
            justify-content: space-between;
        }
    }
</style>
