<script>
    const faqs = [
        {
            question: "А мои данные в безопасности?",
            answer: "Абсолютно. Мы храним их на защищенных серверах с шифрованием. Мы не продаём данные и не показываем рекламу. Это только ваша информация.",
        },
        {
            question: "Смогу ли я забрать свои данные?",
            answer: "Конечно. Вы можете скачать полную историю своих тренировок в CSV в любой момент. Мы не держим ваши данные в заложниках — это доступно даже на бесплатном тарифе.",
        },
        {
            question: "Работает ли это с моими часами?",
            answer: "Сейчас мы поддерживаем загрузку файлов (GPX, TCX, FIT) и синхронизацию со Strava и Garmin Connect (в Pro версии). Мы уже работаем над прямой интеграцией с другими брендами.",
        },
        {
            question: "А как насчет рекламы?",
            answer: "Её нет и не будет. RunTracker делают спортсмены для спортсменов. Мы ценим чистоту и фокус. Проект живет за счет подписок, а не за счет вашего внимания.",
        },
    ];
</script>

<section id="faq" class="faq">
    <div class="container">
        <div class="header">
            <h2>Частые вопросы</h2>
            <p>Всё, что вы хотели знать о RunTracker.</p>
        </div>

        <div class="faq-list">
            {#each faqs as faq}
                <details class="group">
                    <summary>
                        {faq.question}
                        <span class="icon">
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
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </summary>
                    <div class="answer">
                        {faq.answer}
                    </div>
                </details>
            {/each}
        </div>

        <div class="support-link">
            <p>Остались вопросы?</p>
            <a href="mailto:support@runtracker.ru">
                Написать в поддержку
                <svg
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>
</section>

<style>
    .faq {
        padding: 6rem 0;
        background-color: var(--slate-50);
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
    }

    .faq-list {
        max-width: 56rem;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    details {
        background-color: white;
        border: 1px solid var(--slate-200);
        border-radius: 1rem;
        overflow: hidden;
    }

    summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.5rem;
        cursor: pointer;
        font-size: 1.125rem;
        font-weight: 500;
        color: var(--slate-900);
        list-style: none;
        transition: background-color 0.2s;
    }

    summary::-webkit-details-marker {
        display: none;
    }

    summary:hover {
        background-color: var(--slate-50);
    }

    .icon {
        color: var(--slate-500);
        transition: transform 0.3s;
    }

    details[open] .icon {
        transform: rotate(180deg);
    }

    .answer {
        padding: 0 1.5rem 1.5rem 1.5rem;
        color: var(--slate-600);
        line-height: 1.6;
    }

    .support-link {
        margin-top: 4rem;
        text-align: center;
    }

    .support-link p {
        color: var(--slate-600);
        margin-bottom: 1rem;
    }

    .support-link a {
        display: inline-flex;
        align-items: center;
        font-weight: 600;
        color: var(--primary-600);
        transition: color 0.2s;
    }

    .support-link a:hover {
        color: var(--primary-700);
    }

    .support-link svg {
        margin-left: 0.5rem;
    }

    @media (min-width: 768px) {
        h2 {
            font-size: 2.5rem;
        }
    }
</style>
