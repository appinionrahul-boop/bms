<!DOCTYPE html>
<html lang="bn">
<head>
    <title>Budget Management System</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Modern BMS admin panel">

    <link rel="icon" href="{{ asset('Logo-For-BMS-Dashboard.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>

<body class="{{ auth()->check() ? 'admin-body' : 'guest-body' }}">
    @php
        $currentPath = request()->path();
        $titleMap = [
            '' => 'ড্যাশবোর্ড',
            '/' => 'ড্যাশবোর্ড',
            'income' => 'আয়ের হিসাব',
            'income/create' => 'নতুন আয় যোগ করুন',
            'income-category' => 'আয়ের ক্যাটাগরি',
            'expense' => 'ব্যয়ের হিসাব',
            'expense/create' => 'নতুন ব্যয় যোগ করুন',
            'income-challan' => 'আয়ের চালান',
            'expense-challan' => 'ব্যয়ের চালান',
            'settings/fiscal-year' => 'অর্থবছর সেটিং',
        ];
        $pageTitle = $titleMap[$currentPath] ?? 'Budget Management System';

        $menuSections = [
            [
                'label' => 'মেনু',
                'items' => [
                    [
                        'title' => 'আয় ব্যবস্থাপনা',
                        'icon' => 'fas fa-coins',
                        'active' => request()->is('income*') || request()->is('income-category*'),
                        'children' => [
                            [
                                'title' => 'আয়ের হিসাব',
                                'url' => url('/income'),
                                'active' => request()->is('income*'),
                            ],
                            [
                                'title' => 'আয়ের ক্যাটাগরি',
                                'url' => url('/income-category'),
                                'active' => request()->is('income-category*'),
                            ],
                        ],
                    ],
                    [
                        'title' => 'ব্যয় ব্যবস্থাপনা',
                        'icon' => 'fas fa-wallet',
                        'active' => request()->is('expense') || request()->is('expense/create') || request()->is('expense/edit/*') || request()->is('expense_category*'),
                        'children' => [
                            [
                                'title' => 'ব্যয়ের হিসাব',
                                'url' => url('/expense'),
                                'active' => request()->is('expense') || request()->is('expense/create') || request()->is('expense/edit/*'),
                            ],
                            [
                                'title' => 'ব্যয়ের ক্যাটাগরি',
                                'url' => url('/expense_category'),
                                'active' => request()->is('expense_category*'),
                            ],
                        ],
                    ],
                    [
                        'title' => 'চালান',
                        'icon' => 'fas fa-file-invoice-dollar',
                        'active' => request()->is('income-challan') || request()->is('challan/income/*') || request()->is('expense-challan') || request()->is('challan/expense/*'),
                        'children' => [
                            [
                                'title' => 'আয়ের চালান',
                                'url' => url('/income-challan'),
                                'active' => request()->is('income-challan') || request()->is('challan/income/*'),
                            ],
                            [
                                'title' => 'ব্যয়ের চালান',
                                'url' => url('/expense-challan'),
                                'active' => request()->is('expense-challan') || request()->is('challan/expense/*'),
                            ],
                        ],
                    ],
                    [
                        'title' => 'রিপোর্ট',
                        'icon' => 'fas fa-chart-area',
                        'active' => request()->is('report/income-bill-registar') || request()->is('report/income-bill-registar-Gov') || request()->is('report/expense-bill-registar') || request()->is('report/expense-bill-registar-Gov') || request()->is('report/expense/expenseAbs*') || request()->is('report/cashBook*') || request()->is('report/incomeBudget') || request()->is('report/expenseBudget'),
                        'children' => [
                            [
                                'title' => 'আয় রিপোর্ট',
                                'active' => request()->is('report/income-bill-registar') || request()->is('report/income-bill-registar-Gov'),
                                'children' => [
                                    [
                                        'title' => 'বিল রেজিস্ট্রার',
                                        'active' => request()->is('report/income-bill-registar') || request()->is('report/income-bill-registar-Gov'),
                                        'children' => [
                                            [
                                                'title' => 'রাজস্ব আয়',
                                                'url' => url('/report/income-bill-registar'),
                                                'active' => request()->is('report/income-bill-registar'),
                                            ],
                                            [
                                                'title' => 'এডিপি আয়',
                                                'url' => url('/report/income-bill-registar-Gov'),
                                                'active' => request()->is('report/income-bill-registar-Gov'),
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'title' => 'ব্যয় রিপোর্ট',
                                'active' => request()->is('report/expense-bill-registar') || request()->is('report/expense-bill-registar-Gov') || request()->is('report/expense/expenseAbs*'),
                                'children' => [
                                    [
                                        'title' => 'এবস্ট্রাক্ট রিপোর্ট',
                                        'active' => request()->is('report/expense/expenseAbs*'),
                                        'children' => [
                                            [
                                                'title' => 'রাজস্ব',
                                                'url' => url('/report/expense/expenseAbs'),
                                                'active' => request()->is('report/expense/expenseAbs'),
                                            ],
                                            [
                                                'title' => 'এডিপি',
                                                'url' => url('/report/expense/expenseAbsGov'),
                                                'active' => request()->is('report/expense/expenseAbsGov'),
                                            ],
                                        ],
                                    ],
                                    [
                                        'title' => 'বিল রেজিস্ট্রার',
                                        'active' => request()->is('report/expense-bill-registar') || request()->is('report/expense-bill-registar-Gov'),
                                        'children' => [
                                            [
                                                'title' => 'রাজস্ব',
                                                'url' => url('/report/expense-bill-registar'),
                                                'active' => request()->is('report/expense-bill-registar'),
                                            ],
                                            [
                                                'title' => 'এডিপি',
                                                'url' => url('/report/expense-bill-registar-Gov'),
                                                'active' => request()->is('report/expense-bill-registar-Gov'),
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'title' => 'ক্যাশবুক',
                                'active' => request()->is('report/cashBook*'),
                                'children' => [
                                    [
                                        'title' => 'রাজস্ব আয় ব্যয়',
                                        'url' => url('/report/cashBook'),
                                        'active' => request()->is('report/cashBook') && !request()->is('report/cashBookGov'),
                                    ],
                                    [
                                        'title' => 'এডিপি আয় ব্যয়',
                                        'url' => url('/report/cashBookGov'),
                                        'active' => request()->is('report/cashBookGov'),
                                    ],
                                ],
                            ],
                            [
                                'title' => 'বাজেট রিপোর্ট',
                                'active' => request()->is('report/incomeBudget') || request()->is('report/expenseBudget'),
                                'children' => [
                                    [
                                        'title' => 'আয় বাজেট',
                                        'url' => url('/report/incomeBudget'),
                                        'active' => request()->is('report/incomeBudget'),
                                    ],
                                    [
                                        'title' => 'ব্যয় বাজেট',
                                        'url' => url('/report/expenseBudget'),
                                        'active' => request()->is('report/expenseBudget'),
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'title' => 'সেটিংস',
                        'icon' => 'fas fa-cog',
                        'active' => request()->is('settings/fiscal-year'),
                        'children' => [
                            [
                                'title' => 'অ্যাকটিভ অর্থবছর',
                                'url' => url('/settings/fiscal-year'),
                                'active' => request()->is('settings/fiscal-year'),
                            ],
                        ],
                    ],
                ],
            ],
        ];
    @endphp

    @auth
        <div class="admin-shell" id="adminShell">
            <aside class="admin-sidebar" id="adminSidebar">
                <div class="admin-sidebar__brand">
                    <a href="{{ url('/') }}" class="admin-sidebar__brand-link">
                        <img src="{{ asset('Logo-For-BMS-Dashboard.png') }}" alt="BMS">
                        <div>
                            <strong>BMS V2.0</strong>
                            <span>পঞ্চগড় জেলা পরিষদ</span>
                        </div>
                    </a>
                </div>

                <nav class="admin-nav">
                    <div class="admin-nav__group">
                        <span class="admin-nav__label">Overview</span>
                        <a href="{{ url('/') }}" class="admin-nav__link {{ request()->path() === '/' || request()->path() === '' ? 'is-active' : '' }}">
                            <i class="fas fa-chart-line"></i>
                            <span>ড্যাশবোর্ড</span>
                        </a>
                    </div>

                    @foreach ($menuSections as $section)
                        <div class="admin-nav__group">
                            <span class="admin-nav__label">{{ $section['label'] }}</span>

                            @foreach ($section['items'] as $item)
                                <div class="admin-nav__item {{ $item['active'] ? 'is-open' : '' }}">
                                    <button
                                        type="button"
                                        class="admin-nav__toggle"
                                        aria-expanded="{{ $item['active'] ? 'true' : 'false' }}"
                                    >
                                        <span class="admin-nav__toggle-main">
                                            <i class="{{ $item['icon'] }}"></i>
                                            <span>{{ $item['title'] }}</span>
                                        </span>
                                        <i class="fas fa-angle-down admin-nav__toggle-icon"></i>
                                    </button>

                                    <div class="admin-nav__submenu">
                                        @foreach ($item['children'] as $child)
                                            @if (!empty($child['children']))
                                                <div class="admin-nav__item admin-nav__item--nested {{ $child['active'] ? 'is-open' : '' }}">
                                                    <button
                                                        type="button"
                                                        class="admin-nav__toggle admin-nav__toggle--nested"
                                                        aria-expanded="{{ $child['active'] ? 'true' : 'false' }}"
                                                    >
                                                        <span class="admin-nav__toggle-main">
                                                            <i class="fas fa-angle-right"></i>
                                                            <span>{{ $child['title'] }}</span>
                                                        </span>
                                                        <i class="fas fa-angle-down admin-nav__toggle-icon"></i>
                                                    </button>

                                                    <div class="admin-nav__submenu admin-nav__submenu--nested">
                                                        @foreach ($child['children'] as $grandChild)
                                                            @if (!empty($grandChild['children']))
                                                                <div class="admin-nav__item admin-nav__item--nested admin-nav__item--deep {{ $grandChild['active'] ? 'is-open' : '' }}">
                                                                    <button
                                                                        type="button"
                                                                        class="admin-nav__toggle admin-nav__toggle--nested admin-nav__toggle--deep"
                                                                        aria-expanded="{{ $grandChild['active'] ? 'true' : 'false' }}"
                                                                    >
                                                                        <span class="admin-nav__toggle-main">
                                                                            <i class="fas fa-angle-right"></i>
                                                                            <span>{{ $grandChild['title'] }}</span>
                                                                        </span>
                                                                        <i class="fas fa-angle-down admin-nav__toggle-icon"></i>
                                                                    </button>

                                                                    <div class="admin-nav__submenu admin-nav__submenu--nested admin-nav__submenu--deep">
                                                                        @foreach ($grandChild['children'] as $leafChild)
                                                                            <a href="{{ $leafChild['url'] }}" class="admin-nav__sublink admin-nav__sublink--nested admin-nav__sublink--deep {{ $leafChild['active'] ? 'is-active' : '' }}">
                                                                                <span>{{ $leafChild['title'] }}</span>
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <a href="{{ $grandChild['url'] }}" class="admin-nav__sublink admin-nav__sublink--nested {{ $grandChild['active'] ? 'is-active' : '' }}">
                                                                    <span>{{ $grandChild['title'] }}</span>
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @else
                                                <a href="{{ $child['url'] }}" class="admin-nav__sublink {{ $child['active'] ? 'is-active' : '' }}">
                                                    <span>{{ $child['title'] }}</span>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </nav>

                <div class="admin-sidebar__footer">
                    <span>Signed in as</span>
                    <strong>{{ auth()->user()->name }}</strong>
                </div>
            </aside>

            <div class="admin-shell__overlay" id="adminOverlay"></div>

            <div class="admin-main">
                <header class="admin-topbar">
                    <div class="admin-topbar__left">
                        <button type="button" class="admin-topbar__toggle" id="sidebarToggle" aria-label="Toggle sidebar">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="admin-topbar__meta">
                            <p class="admin-topbar__eyebrow">Budget Management System</p>
                            <h1 class="admin-topbar__title">{{ $pageTitle }}</h1>
                        </div>
                    </div>

                    <div class="admin-topbar__right">
                        <div class="admin-topbar__chip">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ now()->timezone(config('app.timezone'))->format('d M Y') }}</span>
                        </div>

                        <div class="admin-user">
                            <div class="admin-user__avatar">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="admin-user__info">
                                <strong>{{ auth()->user()->name }}</strong>
                                <span>{{ auth()->user()->email }}</span>
                            </div>
                            <a href="{{ route('logout') }}"
                               class="admin-user__logout"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </header>

                <main class="admin-content">
                    <div class="admin-page">
                        @includeWhen(View::exists('layouts.message'), 'layouts.message')
                        @yield('content')
                    </div>
                </main>

                <footer class="admin-footer">
                    <p>Developed by Azadia IT Lab</p>
                    <img src="{{ asset('Logo-For-BMS-Dashboard.png') }}" alt="Softus Tech BD">
                </footer>
            </div>
        </div>
    @else
        <div class="guest-shell">
            <div class="guest-shell__panel">
                <div class="guest-shell__brand">
                    <img src="{{ asset('Logo-For-BMS-Dashboard.png') }}" alt="BMS">
                    <div>
                        <strong>Modern BMS</strong>
                        <span>Budget Management System</span>
                    </div>
                </div>

                <div class="guest-shell__content">
                    @yield('content')
                </div>
            </div>
        </div>
    @endauth

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sidebarToggle = document.getElementById('sidebarToggle');
            var adminShell = document.getElementById('adminShell');
            var adminOverlay = document.getElementById('adminOverlay');
            var submenuToggles = document.querySelectorAll('.admin-nav__toggle');

            function toggleSidebar() {
                if (adminShell) {
                    adminShell.classList.toggle('is-sidebar-open');
                }
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            if (adminOverlay) {
                adminOverlay.addEventListener('click', toggleSidebar);
            }

            submenuToggles.forEach(function (toggle) {
                toggle.addEventListener('click', function () {
                    var navItem = toggle.closest('.admin-nav__item');

                    if (!navItem) {
                        return;
                    }

                    var isOpen = navItem.classList.toggle('is-open');
                    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            });

            if (typeof flatpickr === 'function') {
                flatpickr.defaultConfig.disableMobile = true;
                flatpickr.defaultConfig.altInput = false;
                flatpickr.defaultConfig.dateFormat = 'Y-m-d';
                flatpickr.defaultConfig.allowInput = true;
                flatpickr.defaultConfig.monthSelectorType = 'static';

                document.querySelectorAll('[data-datepicker]').forEach(function (element) {
                    if (element._flatpickr) {
                        return;
                    }

                    flatpickr(element, {
                        altInput: false,
                        allowInput: true,
                        dateFormat: 'Y-m-d',
                        disableMobile: true,
                        monthSelectorType: 'static',
                    });
                });

                if (document.querySelector('#date_from') && !document.querySelector('#date_from').dataset.datepicker) {
                    flatpickr('#date_from', {
                        altInput: false,
                        dateFormat: 'Y-m-d',
                        allowInput: true,
                        disableMobile: true,
                        monthSelectorType: 'static',
                    });
                }

                if (document.querySelector('#date_to') && !document.querySelector('#date_to').dataset.datepicker) {
                    flatpickr('#date_to', {
                        altInput: false,
                        dateFormat: 'Y-m-d',
                        allowInput: true,
                        disableMobile: true,
                        monthSelectorType: 'static',
                    });
                }
            }

            if (window.jQuery && $.fn.DataTable && $('#res-config').length) {
                $('#res-config').DataTable({
                    pageLength: 15,
                    responsive: true,
                    order: [],
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
