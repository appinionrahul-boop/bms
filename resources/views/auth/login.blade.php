<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modern BMS Login</title>
    <meta name="description" content="Modern animated finance login page for Budget Management System">

    <link rel="icon" href="{{ asset('Logo-For-BMS-Dashboard.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        :root {
            --login-bg: #081a2d;
            --login-surface: rgba(10, 26, 45, 0.78);
            --login-panel: rgba(255, 255, 255, 0.94);
            --login-line: rgba(255, 255, 255, 0.12);
            --login-text: #e8f2ff;
            --login-soft: rgba(232, 242, 255, 0.7);
            --login-dark: #16314c;
            --login-accent: #1d8cff;
            --login-accent-2: #10b981;
            --login-danger: #ef4444;
            --login-shadow: 0 30px 70px rgba(2, 10, 20, 0.38);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', 'Noto Sans Bengali', sans-serif;
            background:
                radial-gradient(circle at 15% 20%, rgba(29, 140, 255, 0.22), transparent 25%),
                radial-gradient(circle at 85% 18%, rgba(16, 185, 129, 0.18), transparent 24%),
                radial-gradient(circle at 75% 80%, rgba(255, 184, 72, 0.14), transparent 26%),
                linear-gradient(135deg, #06111f 0%, #0d233b 45%, #133962 100%);
            color: var(--login-text);
            overflow-x: hidden;
        }

        .login-scene {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .login-glow,
        .login-glow::before,
        .login-glow::after {
            position: absolute;
            border-radius: 999px;
            filter: blur(8px);
            opacity: 0.8;
            content: "";
        }

        .login-glow {
            inset: auto auto 10% -8%;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(29, 140, 255, 0.34), transparent 68%);
            animation: floatOrb 12s ease-in-out infinite;
        }

        .login-glow::before {
            inset: -260px auto auto 64vw;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.28), transparent 70%);
            animation: floatOrb 16s ease-in-out infinite reverse;
        }

        .login-glow::after {
            inset: 18vh auto auto 50vw;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(255, 184, 72, 0.22), transparent 70%);
            animation: pulseOrb 10s ease-in-out infinite;
        }

        .login-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(420px, 520px);
            gap: 32px;
            min-height: 100vh;
            padding: 32px;
            position: relative;
            z-index: 1;
        }

        .login-showcase,
        .login-panel {
            backdrop-filter: blur(18px);
            border: 1px solid var(--login-line);
            box-shadow: var(--login-shadow);
        }

        .login-showcase {
            background: var(--login-surface);
            border-radius: 34px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            padding: 34px;
            position: relative;
        }

        .login-brand {
            align-items: center;
            display: inline-flex;
            gap: 14px;
        }

        .login-brand img {
            width: 58px;
            height: 58px;
            object-fit: contain;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.08);
            padding: 8px;
        }

        .login-brand strong {
            display: block;
            font-size: 20px;
            letter-spacing: 0.01em;
        }

        .login-brand span {
            color: var(--login-soft);
            display: block;
            font-size: 13px;
            margin-top: 3px;
        }

        .login-hero {
            display: grid;
            gap: 22px;
            max-width: 720px;
            padding: 24px 0;
        }

        .login-kicker {
            align-items: center;
            color: #9fd0ff;
            display: inline-flex;
            gap: 10px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .login-kicker::before {
            width: 42px;
            height: 1px;
            background: rgba(159, 208, 255, 0.6);
            content: "";
        }

        .login-hero h1 {
            font-size: clamp(38px, 4vw, 68px);
            line-height: 1.02;
            margin: 0;
        }

        .login-hero p {
            color: var(--login-soft);
            font-size: 17px;
            line-height: 1.7;
            margin: 0;
            max-width: 640px;
        }

        .login-visuals {
            display: grid;
            gap: 18px;
            grid-template-columns: 1.15fr 0.85fr;
            margin-top: 18px;
        }

        .finance-orbit,
        .finance-stack {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 26px;
            min-height: 270px;
            overflow: hidden;
            padding: 22px;
            position: relative;
        }

        .finance-orbit::before,
        .finance-stack::before {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.06), transparent 50%);
            content: "";
            pointer-events: none;
        }

        .finance-orbit {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .orbit-core {
            width: min(100%, 380px);
            aspect-ratio: 1;
            position: relative;
        }

        .orbit-ring {
            position: absolute;
            inset: 50%;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.14);
            transform: translate(-50%, -50%);
        }

        .orbit-ring--outer {
            width: 100%;
            height: 100%;
            animation: rotateRing 24s linear infinite;
        }

        .orbit-ring--middle {
            width: 72%;
            height: 72%;
            border-style: dashed;
            border-color: rgba(29, 140, 255, 0.24);
            animation: rotateRingReverse 18s linear infinite;
        }

        .orbit-ring--inner {
            width: 46%;
            height: 46%;
            border-color: rgba(16, 185, 129, 0.26);
        }

        .orbit-hub {
            position: absolute;
            inset: 50%;
            width: 120px;
            height: 120px;
            transform: translate(-50%, -50%);
            border-radius: 30px;
            background: linear-gradient(145deg, rgba(13, 45, 76, 0.95), rgba(20, 68, 109, 0.9));
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08), 0 18px 35px rgba(5, 14, 26, 0.28);
            align-items: center;
            display: grid;
            place-items: center;
            z-index: 2;
        }

        .orbit-hub i {
            font-size: 42px;
            color: #bfe1ff;
        }

        .orbit-node {
            position: absolute;
            inset: 50%;
            width: 72px;
            height: 72px;
            margin: -36px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.09);
            border: 1px solid rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(10px);
            align-items: center;
            display: flex;
            justify-content: center;
            transform:
                rotate(var(--angle))
                translateY(calc(var(--radius) * -1))
                rotate(calc(var(--angle) * -1));
            transform-origin: center center;
            animation: nodeFloat 7s ease-in-out infinite;
        }

        .orbit-node i {
            font-size: 24px;
            color: white;
        }

        .orbit-node--blue { background: rgba(29, 140, 255, 0.16); }
        .orbit-node--green { background: rgba(16, 185, 129, 0.16); }
        .orbit-node--gold { background: rgba(255, 184, 72, 0.16); }

        .orbit-node:nth-child(5) { animation-delay: 1s; }
        .orbit-node:nth-child(6) { animation-delay: 2s; }
        .orbit-node:nth-child(7) { animation-delay: 3s; }
        .orbit-node:nth-child(8) { animation-delay: 4s; }

        .finance-stack {
            display: grid;
            gap: 16px;
            align-content: space-between;
        }

        .token-grid {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .token-card {
            min-height: 106px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            padding: 18px;
            animation: cardLift 7s ease-in-out infinite;
        }

        .token-card:nth-child(2) { animation-delay: 1.2s; }
        .token-card:nth-child(3) { animation-delay: 2.4s; }
        .token-card:nth-child(4) { animation-delay: 3.6s; }

        .token-card__icon {
            width: 54px;
            height: 54px;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.14);
        }

        .token-card__icon--blue { background: linear-gradient(135deg, #1788ff, #0d5bd8); }
        .token-card__icon--green { background: linear-gradient(135deg, #16c28f, #0e9f74); }
        .token-card__icon--gold { background: linear-gradient(135deg, #ffbf47, #f08c22); }
        .token-card__icon--violet { background: linear-gradient(135deg, #6d7cff, #4b56dc); }

        .token-card__line,
        .token-card__line::before,
        .token-card__line::after {
            position: absolute;
            left: 18px;
            right: 18px;
            height: 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            content: "";
        }

        .token-card__line {
            bottom: 24px;
        }

        .token-card__line::before {
            bottom: 16px;
            left: 0;
            right: 22%;
        }

        .token-card__line::after {
            bottom: 32px;
            left: 0;
            right: 38%;
        }

        .ledger-strip {
            position: relative;
            min-height: 110px;
            border-radius: 24px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.03));
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
            padding: 20px;
        }

        .ledger-strip::before {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent),
                linear-gradient(180deg, rgba(255, 255, 255, 0.05), transparent);
            transform: translateX(-100%);
            animation: sweepLine 6.5s linear infinite;
            content: "";
        }

        .ledger-pill {
            position: absolute;
            height: 14px;
            border-radius: 999px;
        }

        .ledger-pill--a {
            left: 20px;
            top: 24px;
            width: 46%;
            background: rgba(29, 140, 255, 0.48);
        }

        .ledger-pill--b {
            right: 22px;
            top: 52px;
            width: 34%;
            background: rgba(16, 185, 129, 0.42);
        }

        .ledger-pill--c {
            left: 20px;
            bottom: 24px;
            width: 58%;
            background: rgba(255, 184, 72, 0.38);
        }

        .coin-stack {
            position: absolute;
            right: 22px;
            bottom: 18px;
            width: 90px;
            height: 78px;
        }

        .coin {
            position: absolute;
            left: 50%;
            width: 58px;
            height: 20px;
            margin-left: -29px;
            border-radius: 50%;
            background: linear-gradient(180deg, #ffd36c, #e39d21);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.18);
            animation: coinBounce 4.6s ease-in-out infinite;
        }

        .coin:nth-child(1) { bottom: 0; }
        .coin:nth-child(2) { bottom: 14px; animation-delay: 0.5s; }
        .coin:nth-child(3) { bottom: 28px; animation-delay: 1s; }
        .coin:nth-child(4) { bottom: 42px; animation-delay: 1.5s; }

        .motion-dots {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .motion-dots span {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(191, 225, 255, 0.75);
            animation: dotDrift 8s ease-in-out infinite;
        }

        .motion-dots span:nth-child(1) { left: 14%; top: 24%; animation-delay: 0s; }
        .motion-dots span:nth-child(2) { left: 74%; top: 12%; animation-delay: 1.4s; }
        .motion-dots span:nth-child(3) { left: 22%; bottom: 18%; animation-delay: 2.8s; }
        .motion-dots span:nth-child(4) { right: 12%; bottom: 24%; animation-delay: 4.2s; }

        .activity-item strong {
            display: block;
            font-size: 14px;
        }

        .login-panel {
            align-self: center;
            background: var(--login-panel);
            border-radius: 34px;
            color: var(--login-dark);
            padding: 34px;
            position: relative;
        }

        .login-panel__badge {
            align-items: center;
            background: rgba(29, 140, 255, 0.1);
            border-radius: 999px;
            color: var(--login-accent);
            display: inline-flex;
            font-size: 12px;
            font-weight: 700;
            gap: 8px;
            margin-bottom: 20px;
            padding: 8px 12px;
            text-transform: uppercase;
        }

        .login-panel h2 {
            font-size: 34px;
            line-height: 1.08;
            margin: 0 0 10px;
        }

        .login-panel__intro {
            color: #63788d;
            font-size: 15px;
            line-height: 1.7;
            margin: 0 0 24px;
        }

        .login-form {
            display: grid;
            gap: 18px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        .field label {
            color: #26435d;
            font-size: 13px;
            font-weight: 700;
            margin: 0;
        }

        .field__control {
            position: relative;
        }

        .field__icon {
            align-items: center;
            color: #7e8ea0;
            display: flex;
            font-size: 15px;
            inset: 0 auto 0 14px;
            position: absolute;
        }

        .field input {
            background: rgba(235, 243, 251, 0.88);
            border: 1px solid rgba(26, 61, 97, 0.12);
            border-radius: 18px;
            color: #16314c;
            min-height: 56px;
            outline: none;
            padding: 0 18px 0 44px;
            transition: border-color 160ms ease, box-shadow 160ms ease, transform 160ms ease;
            width: 100%;
        }

        .field input:focus {
            border-color: rgba(29, 140, 255, 0.45);
            box-shadow: 0 0 0 4px rgba(29, 140, 255, 0.12);
            transform: translateY(-1px);
        }

        .field input.is-invalid {
            border-color: rgba(239, 68, 68, 0.45);
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.08);
        }

        .field__error {
            color: var(--login-danger);
            font-size: 12px;
            font-weight: 600;
        }

        .login-form__meta {
            align-items: center;
            display: flex;
            gap: 14px;
            justify-content: space-between;
        }

        .remember {
            align-items: center;
            color: #526b83;
            display: inline-flex;
            font-size: 13px;
            gap: 10px;
        }

        .remember input {
            width: 16px;
            height: 16px;
        }

        .login-form__meta a {
            color: var(--login-accent);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .login-submit {
            align-items: center;
            background: linear-gradient(135deg, #0f7fff 0%, #0958da 100%);
            border: 0;
            border-radius: 18px;
            box-shadow: 0 18px 38px rgba(15, 127, 255, 0.24);
            color: #fff;
            cursor: pointer;
            display: inline-flex;
            font-size: 15px;
            font-weight: 700;
            gap: 10px;
            justify-content: center;
            min-height: 56px;
            padding: 0 22px;
            transition: transform 180ms ease, box-shadow 180ms ease;
            width: 100%;
        }

        .login-submit:hover {
            box-shadow: 0 22px 42px rgba(15, 127, 255, 0.3);
            transform: translateY(-2px);
        }

        .login-footer {
            color: #71839a;
            font-size: 12px;
            line-height: 1.7;
            margin-top: 22px;
            text-align: center;
        }

        .login-footer a {
            color: var(--login-accent);
            font-weight: 700;
            text-decoration: none;
        }

        @keyframes floatOrb {
            0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
            50% { transform: translate3d(24px, -18px, 0) scale(1.08); }
        }

        @keyframes pulseOrb {
            0%, 100% { transform: scale(1); opacity: 0.7; }
            50% { transform: scale(1.14); opacity: 1; }
        }

        @keyframes cardLift {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        @keyframes rotateRing {
            from { transform: translate(-50%, -50%) rotate(0deg); }
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        @keyframes rotateRingReverse {
            from { transform: translate(-50%, -50%) rotate(360deg); }
            to { transform: translate(-50%, -50%) rotate(0deg); }
        }

        @keyframes riseBars {
            0%, 100% { transform: scaleY(0.94); transform-origin: bottom; }
            50% { transform: scaleY(1.04); transform-origin: bottom; }
        }

        @keyframes nodeFloat {
            0%, 100% {
                transform:
                    rotate(var(--angle))
                    translateY(calc(var(--radius) * -1))
                    rotate(calc(var(--angle) * -1))
                    translateY(0);
            }
            50% {
                transform:
                    rotate(var(--angle))
                    translateY(calc(var(--radius) * -1))
                    rotate(calc(var(--angle) * -1))
                    translateY(-8px);
            }
        }

        @keyframes sweepLine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        @keyframes coinBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        @keyframes dotDrift {
            0%, 100% { transform: translate3d(0, 0, 0) scale(1); opacity: 0.45; }
            50% { transform: translate3d(8px, -10px, 0) scale(1.25); opacity: 0.95; }
        }

        @media (max-width: 1199.98px) {
            .login-grid {
                grid-template-columns: 1fr;
            }

            .login-showcase {
                min-height: auto;
            }

            .login-panel {
                max-width: 560px;
                justify-self: center;
                width: 100%;
            }
        }

        @media (max-width: 767.98px) {
            .login-grid {
                padding: 18px;
            }

            .login-showcase,
            .login-panel {
                border-radius: 26px;
                padding: 24px;
            }

            .login-visuals {
                grid-template-columns: 1fr;
            }

            .login-form__meta {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="login-scene">
        <div class="login-glow"></div>

        <div class="login-grid">
            <section class="login-showcase">
                <div>
                    <div class="login-brand">
                        <img src="{{ asset('Logo-For-BMS-Dashboard.png') }}" alt="Modern BMS">
                        <div>
                            <strong>পঞ্চগড় জেলা পরিষদ</strong>
                            <span>Accounts and Financial Operations Hub</span>
                        </div>
                    </div>

                    <div class="login-hero">
                        <div class="login-kicker">Accounts and Financials</div>

                        <div class="login-visuals">
                            <div class="finance-orbit" aria-hidden="true">
                                <div class="orbit-core">
                                    <div class="motion-dots">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class="orbit-ring orbit-ring--outer"></div>
                                    <div class="orbit-ring orbit-ring--middle"></div>
                                    <div class="orbit-ring orbit-ring--inner"></div>
                                    <div class="orbit-hub">
                                        <i class="fas fa-landmark"></i>
                                    </div>
                                    <div class="orbit-node orbit-node--blue" style="--angle: 16deg; --radius: 154px;">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                    <div class="orbit-node orbit-node--green" style="--angle: 104deg; --radius: 146px;">
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </div>
                                    <div class="orbit-node orbit-node--gold" style="--angle: 196deg; --radius: 154px;">
                                        <i class="fas fa-coins"></i>
                                    </div>
                                    <div class="orbit-node orbit-node--blue" style="--angle: 286deg; --radius: 146px;">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="finance-stack" aria-hidden="true">
                                <div class="token-grid">
                                    <div class="token-card">
                                        <div class="token-card__icon token-card__icon--blue">
                                            <i class="fas fa-book-open"></i>
                                        </div>
                                        <div class="token-card__line"></div>
                                    </div>
                                    <div class="token-card">
                                        <div class="token-card__icon token-card__icon--green">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                        <div class="token-card__line"></div>
                                    </div>
                                    <div class="token-card">
                                        <div class="token-card__icon token-card__icon--gold">
                                            <i class="fas fa-piggy-bank"></i>
                                        </div>
                                        <div class="token-card__line"></div>
                                    </div>
                                    <div class="token-card">
                                        <div class="token-card__icon token-card__icon--violet">
                                            <i class="fas fa-receipt"></i>
                                        </div>
                                        <div class="token-card__line"></div>
                                    </div>
                                </div>

                                <div class="ledger-strip">
                                    <div class="ledger-pill ledger-pill--a"></div>
                                    <div class="ledger-pill ledger-pill--b"></div>
                                    <div class="ledger-pill ledger-pill--c"></div>
                                    <div class="coin-stack">
                                        <div class="coin"></div>
                                        <div class="coin"></div>
                                        <div class="coin"></div>
                                        <div class="coin"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="login-panel">
                <div class="login-panel__badge">Secure Sign In</div>
                <h2>Welcome back</h2>
                <p class="login-panel__intro">
                    Sign in to continue managing accounts, financial reports, budget entries, and daily records.
                </p>

                <form class="login-form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <label for="email">Email Address</label>
                        <div class="field__control">
                            <span class="field__icon">@</span>
                            <input id="email"
                                   type="email"
                                   class="@error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="email"
                                   autofocus
                                   placeholder="Enter your email">
                        </div>
                        @error('email')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <div class="field__control">
                            <span class="field__icon">#</span>
                            <input id="password"
                                   type="password"
                                   class="@error('password') is-invalid @enderror"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                                   placeholder="Enter your password">
                        </div>
                        @error('password')
                            <div class="field__error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="login-form__meta">
                        <label class="remember" for="remember">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="login-submit">
                        <span>Enter Dashboard</span>
                        <span>→</span>
                    </button>
                </form>

                <div class="login-footer">
                    Budget Management System for modern accounts and financial workflows.
                    <a href="https://softustechbd.com">Developed by Azadia IT Lab</a>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
