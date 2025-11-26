<script>
    const features = [
        {
            title: "Следите за формой",
            description:
                "Наглядные графики покажут, как меняется ваш темп и выносливость от недели к неделе.",
            icon: `<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>`,
        },
        {
            title: "Тренируйтесь без перегрузок",
            description:
                "Поможем найти баланс между нагрузкой и восстановлением, чтобы избежать травм.",
            icon: `<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>`,
        },
        {
            title: "Готовьтесь к стартам",
            description:
                "Структурированные планы подготовки к марафону и другим дистанциям.",
            icon: `<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>`,
        },
        {
            title: "Записывайте на лету",
            description:
                "Добавляйте тренировки за пару секунд. Минимум полей — максимум пользы.",
            icon: `<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>`,
        },
        {
            title: "Вся история в одном месте",
            description:
                "Легко загружайте данные из Strava и Garmin. Экспортируйте в CSV когда угодно.",
            icon: `<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>`,
        },
        {
            title: "Ваши данные — только ваши",
            description:
                "Мы уважаем вашу приватность. Никакой продажи данных и навязчивой рекламы.",
            icon: `<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>`,
        },
    ];
</script>

<section id="features" class="features">
    <div class="container">
        <div class="header">
            <h2>Фокус на главном</h2>
            <p>
                Никакого информационного шума. Только ваши усилия и честный
                прогресс.
            </p>
        </div>

        <div class="grid">
            {#each features as feature}
                <div class="card">
                    <div class="icon-wrapper">
                        {@html feature.icon}
                    </div>
                    <h3>{feature.title}</h3>
                    <p>{feature.description}</p>
                </div>
            {/each}
        </div>
    </div>
</section>

<style>
    .features {
        padding: 6rem 0;
        background-color: white;
    }

    .header {
        text-align: center;
        margin-bottom: 4rem;
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

    .grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .card {
        padding: 2rem;
        background-color: var(--slate-50);
        border: 1px solid var(--slate-100);
        border-radius: 1.5rem;
        transition: all 0.3s ease;
    }

    .card:hover {
        background-color: white;
        border-color: var(--slate-200);
        box-shadow:
            0 20px 25px -5px rgba(0, 0, 0, 0.1),
            0 10px 10px -5px rgba(0, 0, 0, 0.04);
        transform: translateY(-2px);
    }

    .icon-wrapper {
        width: 3.5rem;
        height: 3.5rem;
        background-color: white;
        border: 1px solid var(--slate-100);
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        color: var(--primary-600);
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .card:hover .icon-wrapper {
        transform: scale(1.1);
    }

    h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--slate-900);
        margin: 0 0 0.75rem 0;
    }

    .card p {
        color: var(--slate-600);
        line-height: 1.6;
        margin: 0;
    }

    @media (min-width: 640px) {
        .grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .grid {
            grid-template-columns: repeat(3, 1fr);
        }
        h2 {
            font-size: 2.5rem;
        }
    }
</style>
