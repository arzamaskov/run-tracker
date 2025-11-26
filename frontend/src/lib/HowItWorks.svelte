<section id="how" class="how-it-works">
    <div class="decorative-line top"></div>
    <div class="decorative-line bottom"></div>

    <div class="container">
        <div class="header">
            <h2>Как это работает</h2>
            <p>Три простых шага к осознанным тренировкам.</p>
        </div>

        <div class="steps-grid">
            <div class="connecting-line"></div>

            <div class="step">
                <div class="step-number">1</div>
                <h3>Быстрый старт</h3>
                <p>
                    Регистрация займет меньше минуты. Мы спросим только самое
                    важное, чтобы вы могли сразу начать.
                </p>
            </div>

            <div class="step">
                <div class="step-number">2</div>
                <h3>Вся история в одном месте</h3>
                <p>
                    Подключите Strava или Garmin, чтобы собрать все прошлые
                    пробежки. Или просто добавьте их вручную.
                </p>
            </div>

            <div class="step">
                <div class="step-number">3</div>
                <h3>Анализируйте с умом</h3>
                <p>
                    Следите за формой, контролируйте нагрузку и получайте
                    персональные советы по восстановлению.
                </p>
            </div>
        </div>

        <div class="cta-wrapper">
            <a href="/register" class="btn-start">
                Начать сейчас
                <svg
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </div>
</section>

<style>
    .how-it-works {
        position: relative;
        padding: 6rem 0;
        background-color: var(--slate-50);
        overflow: hidden;
    }

    .decorative-line {
        position: absolute;
        left: 0;
        width: 100%;
        height: 1px;
        background: linear-gradient(
            to right,
            transparent,
            var(--slate-200),
            transparent
        );
    }

    .decorative-line.top {
        top: 0;
    }
    .decorative-line.bottom {
        bottom: 0;
    }

    .header {
        text-align: center;
        margin-bottom: 5rem;
    }

    h2 {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--slate-900);
        margin-bottom: 1rem;
        letter-spacing: -0.025em;
    }

    .header p {
        font-size: 1.125rem;
        color: var(--slate-600);
        max-width: 42rem;
        margin: 0 auto;
    }

    .steps-grid {
        position: relative;
        display: grid;
        grid-template-columns: 1fr;
        gap: 3rem;
    }

    .connecting-line {
        display: none;
        position: absolute;
        top: 3rem;
        left: 16%;
        right: 16%;
        height: 2px;
        background: linear-gradient(
            to right,
            var(--slate-200),
            var(--primary-200),
            var(--slate-200)
        );
        z-index: 0;
    }

    .step {
        position: relative;
        text-align: center;
        z-index: 1;
    }

    .step-number {
        width: 6rem;
        height: 6rem;
        background-color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem auto;
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--primary-600);
        box-shadow: 0 10px 15px -3px rgba(226, 232, 240, 0.5);
        border: 4px solid var(--slate-50);
        transition: border-color 0.3s;
    }

    .step:hover .step-number {
        border-color: var(--primary-50);
    }

    h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--slate-900);
        margin-bottom: 0.75rem;
    }

    p {
        color: var(--slate-600);
        line-height: 1.6;
        padding: 0 1rem;
    }

    .cta-wrapper {
        margin-top: 4rem;
        text-align: center;
    }

    .btn-start {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 2rem;
        background-color: var(--slate-900);
        color: white;
        font-size: 1.125rem;
        font-weight: 500;
        border-radius: 1rem;
        transition: all 0.2s;
        box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.2);
    }

    .btn-start:hover {
        background-color: var(--slate-800);
        transform: translateY(-1px);
        box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.4);
    }

    .btn-start svg {
        margin-left: 0.5rem;
        margin-right: -0.25rem;
    }

    @media (min-width: 768px) {
        .steps-grid {
            grid-template-columns: repeat(3, 1fr);
        }
        .connecting-line {
            display: block;
        }
        h2 {
            font-size: 2.5rem;
        }
    }
</style>
