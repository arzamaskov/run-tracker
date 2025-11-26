<script>
    const version = __APP_VERSION__;
</script>

<section class="hero">
    <div class="bg-grid"></div>
    <div class="bg-glow"></div>

    <div class="container">
        <div class="hero-content">
            <div class="badge">
                <span class="dot"></span>
                RunTracker v{version} — ваш старт к новым победам
            </div>

            <h1>
                Умные тренировки. <br class="md-break" />
                <span class="gradient-text">Уверенный прогресс.</span>
            </h1>

            <p class="subtitle">
                Ваш личный центр управления бегом. Мы поможем следить за
                нагрузкой, анализировать прогресс и достигать целей — легко и
                без лишней суеты.
            </p>

            <div class="cta-group">
                <a href="/register" class="btn-primary">Начать бесплатно</a>
                <a href="#how" class="btn-secondary">Как это работает</a>
            </div>

            <div class="dashboard-preview">
                <div class="glow-behind"></div>
                <div class="preview-card">
                    <div class="placeholder-content">
                        <svg
                            width="96"
                            height="96"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect
                                x="3"
                                y="3"
                                width="18"
                                height="18"
                                rx="2"
                                ry="2"
                            />
                            <line x1="3" y1="9" x2="21" y2="9" />
                            <line x1="9" y1="21" x2="9" y2="9" />
                        </svg>
                        <span>Скриншот интерфейса</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .hero {
        position: relative;
        padding-top: 8rem;
        padding-bottom: 5rem;
        overflow: hidden;
        text-align: center;
    }

    .bg-grid {
        position: absolute;
        inset: 0;
        z-index: -10;
        background-image: linear-gradient(
                to right,
                rgba(128, 128, 128, 0.04) 1px,
                transparent 1px
            ),
            linear-gradient(
                to bottom,
                rgba(128, 128, 128, 0.04) 1px,
                transparent 1px
            );
        background-size: 14px 24px;
        background-color: white;
    }

    .bg-glow {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 310px;
        height: 310px;
        background-color: var(--primary-400);
        opacity: 0.2;
        filter: blur(100px);
        border-radius: 50%;
        z-index: -10;
    }

    .hero-content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        background-color: var(--primary-50);
        border: 1px solid var(--primary-200);
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--primary-800);
        margin-bottom: 2rem;
    }

    .dot {
        width: 0.5rem;
        height: 0.5rem;
        background-color: var(--primary-600);
        border-radius: 50%;
        margin-right: 0.5rem;
    }

    h1 {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--slate-900);
        line-height: 1.1;
        margin: 0 0 2rem 0;
        letter-spacing: -0.025em;
    }

    .md-break {
        display: none;
    }

    .gradient-text {
        background: linear-gradient(to right, var(--primary-600), #4f46e5);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .subtitle {
        font-size: 1.125rem;
        color: var(--slate-600);
        max-width: 48rem;
        margin-bottom: 2.5rem;
        line-height: 1.6;
    }

    .cta-group {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        width: 100%;
        max-width: 24rem;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 2rem;
        background-color: var(--primary-600);
        color: white;
        font-size: 1.125rem;
        font-weight: 600;
        border-radius: 1rem;
        transition: all 0.2s;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
    }

    .btn-primary:hover {
        background-color: var(--primary-700);
        transform: translateY(-1px);
        box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.4);
    }

    .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 2rem;
        background-color: white;
        color: var(--slate-700);
        font-size: 1.125rem;
        font-weight: 600;
        border: 1px solid var(--slate-200);
        border-radius: 1rem;
        transition: all 0.2s;
    }

    .btn-secondary:hover {
        background-color: var(--slate-50);
    }

    .dashboard-preview {
        margin-top: 4rem;
        position: relative;
        width: 100%;
        max-width: 64rem;
    }

    .glow-behind {
        position: absolute;
        inset: -4px;
        background: linear-gradient(to right, var(--primary-500), #6366f1);
        border-radius: 1rem;
        filter: blur(20px);
        opacity: 0.2;
        z-index: -1;
    }

    .preview-card {
        position: relative;
        background-color: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(24px);
        border: 1px solid var(--slate-200);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .placeholder-content {
        aspect-ratio: 16 / 9;
        background-color: var(--slate-50);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--slate-300);
    }

    .placeholder-content span {
        margin-top: 1rem;
        font-size: 0.875rem;
        font-weight: 500;
    }

    @media (min-width: 640px) {
        h1 {
            font-size: 3rem;
        }
        .cta-group {
            flex-direction: row;
            width: auto;
            max-width: none;
        }
    }

    @media (min-width: 768px) {
        .hero {
            padding-top: 12rem;
            padding-bottom: 8rem;
        }
        h1 {
            font-size: 4.5rem;
        }
        .md-break {
            display: block;
        }
        .subtitle {
            font-size: 1.25rem;
        }
        .dashboard-preview {
            margin-top: 6rem;
        }
    }
</style>
