const React = require('react');

const MONTH_LABELS = {
    July: 'জুলাই',
    August: 'আগস্ট',
    September: 'সেপ্টেম্বর',
    October: 'অক্টোবর',
    November: 'নভেম্বর',
    December: 'ডিসেম্বর',
    January: 'জানুয়ারি',
    February: 'ফেব্রুয়ারি',
    March: 'মার্চ',
    April: 'এপ্রিল',
    May: 'মে',
    June: 'জুন',
};

const cardPalette = [
    { accent: '#1278ff', glow: 'rgba(18, 120, 255, 0.18)' },
    { accent: '#11b87f', glow: 'rgba(17, 184, 127, 0.18)' },
    { accent: '#ff8d3b', glow: 'rgba(255, 141, 59, 0.18)' },
    { accent: '#f5517c', glow: 'rgba(245, 81, 124, 0.18)' },
    { accent: '#7357ff', glow: 'rgba(115, 87, 255, 0.18)' },
    { accent: '#00a7c4', glow: 'rgba(0, 167, 196, 0.18)' },
    { accent: '#ffc145', glow: 'rgba(255, 193, 69, 0.18)' },
    { accent: '#3749a9', glow: 'rgba(55, 73, 169, 0.18)' },
];

function formatBanglaNumber(value) {
    return new Intl.NumberFormat('bn-BD', {
        maximumFractionDigits: 0,
    }).format(Number(value || 0));
}

function formatBanglaPercent(value) {
    return new Intl.NumberFormat('bn-BD', {
        maximumFractionDigits: 1,
        minimumFractionDigits: 0,
    }).format(Number(value || 0));
}

function DashboardCard({ item, index }) {
    const palette = cardPalette[index % cardPalette.length];

    return (
        <div className="react-dashboard-card" style={{ '--card-accent': palette.accent, '--card-glow': palette.glow }}>
            <div className="react-dashboard-card__eyebrow">{item.label}</div>
            <div className="react-dashboard-card__value">{formatBanglaNumber(item.value)}</div>
        </div>
    );
}

function HeroPanel({ fiscalYear, totals }) {
    const surplus = Number(totals.surplus || 0);

    return (
        <section className="react-dashboard-hero">
            <div className="react-dashboard-hero__content">
                <p className="react-dashboard-hero__eyebrow">Budget Management Analytics</p>
                <h2 className="react-dashboard-hero__title">অর্থবছর {fiscalYear || 'নির্ধারিত নয়'} এর স্মার্ট বিশ্লেষণ</h2>
                <p className="react-dashboard-hero__copy">
                    আয়, ব্যয়, রাজস্ব প্রবাহ, এডিপি কার্যক্রম এবং সামগ্রিক আর্থিক স্থিতি এক জায়গা থেকে দ্রুত দেখুন।
                </p>
            </div>

            <div className="react-dashboard-hero__stats">
                <div className="react-dashboard-hero__stat">
                    <span>বর্তমান স্থিতি</span>
                    <strong className={surplus >= 0 ? 'is-positive' : 'is-negative'}>
                        {formatBanglaNumber(surplus)}
                    </strong>
                </div>
                <div className="react-dashboard-hero__stat">
                    <span>ব্যয় হার</span>
                    <strong>{formatBanglaPercent(totals.burnRate)}%</strong>
                </div>
                <div className="react-dashboard-hero__stat">
                    <span>এডিপি শেয়ার</span>
                    <strong>{formatBanglaPercent(totals.govShare)}%</strong>
                </div>
            </div>
        </section>
    );
}

function InsightPanel({ totals }) {
    const ownBalance = Number(totals.ownIncome || 0) - Number(totals.ownExpense || 0);
    const govBalance = Number(totals.govIncome || 0) - Number(totals.govExpense || 0);

    return (
        <section className="react-dashboard-panel react-dashboard-panel--dark">
            <p className="react-dashboard-panel__eyebrow">দ্রুত ইনসাইট</p>
            <h3 className="react-dashboard-panel__title">Financial Snapshot</h3>

            <div className="react-dashboard-insights">
                <div className="react-dashboard-insight">
                    <span>রাজস্ব স্থিতি</span>
                    <strong>{formatBanglaNumber(ownBalance)}</strong>
                </div>
                <div className="react-dashboard-insight">
                    <span>এডিপি স্থিতি</span>
                    <strong>{formatBanglaNumber(govBalance)}</strong>
                </div>
                <div className="react-dashboard-insight">
                    <span>মোট এন্ট্রি</span>
                    <strong>{formatBanglaNumber(totals.recordCount)}</strong>
                </div>
            </div>
        </section>
    );
}

function RankingPanel({ title, eyebrow, items, type }) {
    const maxValue = Math.max(...items.map((item) => Number(item.value || 0)), 1);

    return (
        <section className="react-dashboard-panel">
            <div className="react-dashboard-panel__header">
                <div>
                    <p className="react-dashboard-panel__eyebrow">{eyebrow}</p>
                    <h3 className="react-dashboard-panel__title">{title}</h3>
                </div>
            </div>

            <div className="react-dashboard-ranking">
                {items.map((item) => (
                    <div className="react-dashboard-ranking__item" key={item.key}>
                        <div className="react-dashboard-ranking__meta">
                            <strong>{item.label}</strong>
                            <span>{formatBanglaNumber(item.value)}</span>
                        </div>
                        <div className="react-dashboard-ranking__track">
                            <div
                                className={`react-dashboard-ranking__fill ${type === 'expense' ? 'is-expense' : 'is-income'}`}
                                style={{ width: `${Math.max((Number(item.value || 0) / maxValue) * 100, 6)}%` }}
                            />
                        </div>
                    </div>
                ))}
            </div>
        </section>
    );
}

function ActivityPanel({ items }) {
    return (
        <section className="react-dashboard-panel">
            <div className="react-dashboard-panel__header">
                <div>
                    <p className="react-dashboard-panel__eyebrow">সাম্প্রতিক কার্যক্রম</p>
                    <h3 className="react-dashboard-panel__title">Latest Entries</h3>
                </div>
            </div>

            <div className="react-dashboard-activity">
                {items.map((item) => (
                    <div className="react-dashboard-activity__item" key={item.key}>
                        <div className={`react-dashboard-activity__badge ${item.type === 'income' ? 'is-income' : 'is-expense'}`}>
                            {item.type === 'income' ? 'আয়' : 'ব্যয়'}
                        </div>
                        <div className="react-dashboard-activity__content">
                            <strong>{item.label}</strong>
                            <span>{item.meta}</span>
                        </div>
                        <div className="react-dashboard-activity__side">
                            <strong>{formatBanglaNumber(item.amount)}</strong>
                            <span>{item.date}</span>
                        </div>
                    </div>
                ))}
            </div>
        </section>
    );
}

function DashboardApp({ data }) {
    const cards = data.cards || [];
    const topIncomeSources = data.topIncomeSources || [];
    const topExpenseCategories = data.topExpenseCategories || [];
    const recentActivity = data.recentActivity || [];

    return (
        <div className="react-dashboard">
            <style>{`
                .react-dashboard {
                    display: grid;
                    gap: 24px;
                    color: #16324f;
                }
                .react-dashboard-hero {
                    background:
                        radial-gradient(circle at top right, rgba(48, 164, 255, 0.24), transparent 28%),
                        radial-gradient(circle at bottom left, rgba(24, 209, 142, 0.16), transparent 22%),
                        linear-gradient(135deg, #0f2d4c 0%, #143f69 58%, #1c6298 100%);
                    border-radius: 30px;
                    box-shadow: 0 24px 60px rgba(14, 43, 76, 0.22);
                    color: #f6fbff;
                    display: grid;
                    gap: 24px;
                    grid-template-columns: minmax(0, 1.7fr) minmax(280px, 1fr);
                    overflow: hidden;
                    padding: 30px;
                    position: relative;
                }
                .react-dashboard-hero__eyebrow,
                .react-dashboard-panel__eyebrow {
                    font-size: 12px;
                    letter-spacing: 0.12em;
                    margin: 0 0 8px;
                    opacity: 0.75;
                    text-transform: uppercase;
                }
                .react-dashboard-hero__title,
                .react-dashboard-panel__title {
                    margin: 0;
                }
                .react-dashboard-hero__title {
                    font-size: clamp(30px, 4vw, 44px);
                    line-height: 1.08;
                    max-width: 10ch;
                }
                .react-dashboard-hero__copy {
                    color: rgba(246, 251, 255, 0.78);
                    font-size: 15px;
                    line-height: 1.7;
                    margin: 16px 0 0;
                    max-width: 56ch;
                }
                .react-dashboard-hero__stats {
                    display: grid;
                    gap: 14px;
                }
                .react-dashboard-hero__stat {
                    background: rgba(255, 255, 255, 0.09);
                    border: 1px solid rgba(255, 255, 255, 0.12);
                    border-radius: 22px;
                    padding: 18px 20px;
                }
                .react-dashboard-hero__stat span {
                    color: rgba(246, 251, 255, 0.72);
                    display: block;
                    font-size: 13px;
                    margin-bottom: 8px;
                }
                .react-dashboard-hero__stat strong {
                    display: block;
                    font-size: 30px;
                    line-height: 1.1;
                }
                .react-dashboard-hero__stat .is-positive {
                    color: #7ef0ba;
                }
                .react-dashboard-hero__stat .is-negative {
                    color: #ffb7c6;
                }
                .react-dashboard__grid {
                    display: grid;
                    gap: 18px;
                    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                }
                .react-dashboard-card {
                    background:
                        radial-gradient(circle at top right, var(--card-glow), transparent 42%),
                        linear-gradient(155deg, #ffffff 0%, #f6faff 100%);
                    border: 1px solid rgba(22, 50, 79, 0.08);
                    border-radius: 22px;
                    box-shadow: 0 18px 40px rgba(22, 50, 79, 0.08);
                    overflow: hidden;
                    padding: 22px;
                    position: relative;
                }
                .react-dashboard-card::after {
                    background: linear-gradient(90deg, var(--card-accent), transparent);
                    border-radius: 999px 999px 0 0;
                    bottom: 0;
                    content: "";
                    height: 4px;
                    left: 18px;
                    position: absolute;
                    right: 18px;
                }
                .react-dashboard-card__eyebrow {
                    color: #5d7288;
                    font-size: 14px;
                    margin-bottom: 10px;
                }
                .react-dashboard-card__value {
                    color: #10253d;
                    font-size: clamp(22px, 2.3vw, 32px);
                    font-weight: 700;
                    line-height: 1.1;
                    overflow-wrap: anywhere;
                    word-break: break-word;
                }
                .react-dashboard__side {
                    display: grid;
                    gap: 22px;
                }
                .react-dashboard__bottom {
                    display: grid;
                    gap: 22px;
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
                .react-dashboard-panel {
                    background: #ffffff;
                    border: 1px solid rgba(22, 50, 79, 0.08);
                    border-radius: 26px;
                    box-shadow: 0 18px 40px rgba(22, 50, 79, 0.08);
                    padding: 24px;
                }
                .react-dashboard-panel--dark {
                    background:
                        radial-gradient(circle at top right, rgba(48, 164, 255, 0.18), transparent 34%),
                        linear-gradient(155deg, #102e4b 0%, #163d62 100%);
                    color: #f4f8fc;
                }
                .react-dashboard-panel__header {
                    align-items: center;
                    display: flex;
                    gap: 16px;
                    justify-content: space-between;
                    margin-bottom: 22px;
                }
                .react-dashboard-insights {
                    display: grid;
                    gap: 14px;
                }
                .react-dashboard-insight {
                    background: rgba(255, 255, 255, 0.08);
                    border: 1px solid rgba(255, 255, 255, 0.08);
                    border-radius: 18px;
                    padding: 16px 18px;
                }
                .react-dashboard-insight span {
                    color: rgba(244, 248, 252, 0.7);
                    display: block;
                    font-size: 13px;
                    margin-bottom: 6px;
                }
                .react-dashboard-insight strong {
                    display: block;
                    font-size: 28px;
                }
                .react-dashboard-ranking {
                    display: grid;
                    gap: 16px;
                }
                .react-dashboard-ranking__item {
                    display: grid;
                    gap: 10px;
                }
                .react-dashboard-ranking__meta {
                    align-items: baseline;
                    display: flex;
                    gap: 10px;
                    justify-content: space-between;
                }
                .react-dashboard-ranking__meta strong {
                    font-size: 14px;
                }
                .react-dashboard-ranking__meta span {
                    color: #5d7288;
                    font-size: 13px;
                }
                .react-dashboard-ranking__track {
                    background: #ecf3f9;
                    border-radius: 999px;
                    height: 10px;
                    overflow: hidden;
                }
                .react-dashboard-ranking__fill {
                    border-radius: inherit;
                    height: 100%;
                }
                .react-dashboard-ranking__fill.is-income {
                    background: linear-gradient(90deg, #23d092 0%, #0e9d69 100%);
                }
                .react-dashboard-ranking__fill.is-expense {
                    background: linear-gradient(90deg, #25a1ff 0%, #1554d1 100%);
                }
                .react-dashboard-activity {
                    display: grid;
                    gap: 14px;
                }
                .react-dashboard-activity__item {
                    align-items: center;
                    background: linear-gradient(155deg, #fbfdff 0%, #f2f7fc 100%);
                    border: 1px solid rgba(22, 50, 79, 0.08);
                    border-radius: 18px;
                    display: grid;
                    gap: 14px;
                    grid-template-columns: auto minmax(0, 1fr) auto;
                    padding: 14px 16px;
                }
                .react-dashboard-activity__badge {
                    border-radius: 999px;
                    color: #fff;
                    font-size: 12px;
                    font-weight: 700;
                    padding: 8px 10px;
                }
                .react-dashboard-activity__badge.is-income {
                    background: linear-gradient(135deg, #23d092 0%, #0e9d69 100%);
                }
                .react-dashboard-activity__badge.is-expense {
                    background: linear-gradient(135deg, #25a1ff 0%, #1554d1 100%);
                }
                .react-dashboard-activity__content,
                .react-dashboard-activity__side {
                    display: grid;
                    gap: 4px;
                }
                .react-dashboard-activity__content strong,
                .react-dashboard-activity__side strong {
                    font-size: 14px;
                }
                .react-dashboard-activity__content span,
                .react-dashboard-activity__side span {
                    color: #5d7288;
                    font-size: 12px;
                }
                .react-dashboard-activity__side {
                    justify-items: end;
                    text-align: right;
                }
                @media (max-width: 1199px) {
                    .react-dashboard__bottom,
                    .react-dashboard-hero {
                        grid-template-columns: 1fr;
                    }
                }
                @media (max-width: 767px) {
                    .react-dashboard-hero,
                    .react-dashboard-panel {
                        padding: 20px;
                    }
                    .react-dashboard-panel__header,
                    .react-dashboard-activity__item {
                        grid-template-columns: 1fr;
                    }
                    .react-dashboard-panel__header,
                    .react-dashboard-activity__side {
                        justify-items: start;
                        text-align: left;
                    }
                }
            `}</style>

            <HeroPanel fiscalYear={data.fiscalYear} totals={data.totals || {}} />

            <div className="react-dashboard__grid">
                {cards.map((item, index) => (
                    <DashboardCard item={item} index={index} key={item.key} />
                ))}
            </div>

            <div className="react-dashboard__side">
                <InsightPanel totals={data.totals || {}} />
                <ActivityPanel items={recentActivity} />
            </div>

            <div className="react-dashboard__bottom">
                <RankingPanel
                    title="Top Income Sources"
                    eyebrow="আয়ের উৎস"
                    items={topIncomeSources}
                    type="income"
                />
                <RankingPanel
                    title="Top Expense Categories"
                    eyebrow="ব্যয়ের খাত"
                    items={topExpenseCategories}
                    type="expense"
                />
            </div>
        </div>
    );
}

module.exports = DashboardApp;
