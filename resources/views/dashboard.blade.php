<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h2 class="text-xl fw-bold text-white mb-2 mb-md-0">
                <i class="fas fa-tachometer-alt me-2 text-warning"></i> Dashboard
            </h2>
            <a href="{{ route('home') }}"
               class="btn btn-lg rounded-pill fw-semibold text-dark shadow"
               style="background: linear-gradient(135deg, #FFC371, #FF5F6D); border-radius: 5px;">
                <i class="fas fa-home me-2"></i> Home
            </a>
        </div>
    </x-slot>

    <div class="dashboard-shell py-5">
        <div class="container">
            <div class="hero-panel mb-4 shadow-lg border-0">
                <div class="card-body text-white p-4 p-lg-5">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <span class="eyebrow">Cafe Express Control Center</span>
                            <h3 class="hero-title mt-2 mb-3">Orders, staff assignments, aur restaurant flow ko ek hi jagah se track karo.</h3>
                            <p class="hero-copy mb-4">
                                Dashboard ab operations-focused hai. Yahan se unassigned orders dekh sakte ho,
                                staff assignment page open kar sakte ho, aur recent allocations monitor kar sakte ho.
                            </p>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('staff.create') }}" class="btn btn-warning btn-lg rounded-pill fw-semibold text-dark">
                                    <i class="fas fa-user-check me-2"></i> Assign Orders
                                </a>
                                <a href="{{ route('orders.index') }}" class="btn btn-outline-light btn-lg rounded-pill fw-semibold">
                                    <i class="fas fa-receipt me-2"></i> View Orders
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="highlight-box">
                                <span class="highlight-label">Priority Queue</span>
                                <div class="highlight-number">{{ $unassignedOrders }}</div>
                                <p class="highlight-copy mb-0">Active orders abhi bhi staff assignment ka wait kar rahe hain.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $cards = [
                    ['title' => 'Total Customers', 'icon' => 'users', 'value' => $totalCustomers, 'gradient' => ['#ff6a00', '#ee0979']],
                    ['title' => 'Menu Items', 'icon' => 'utensils', 'value' => $totalItems, 'gradient' => ['#43cea2', '#185a9d']],
                    ['title' => 'Total Orders', 'icon' => 'receipt', 'value' => $totalOrders, 'gradient' => ['#00b09b', '#96c93d']],
                    ['title' => 'Staff Members', 'icon' => 'user-check', 'value' => $totalStaff, 'gradient' => ['#7f00ff', '#e100ff']],
                ];
            @endphp

            <div class="cards-container mb-4">
                @foreach ($cards as $card)
                    <div class="counter-card d-flex flex-column justify-content-center align-items-center shadow-lg border-0"
                         style="border-radius: 24px; background: linear-gradient(135deg, {{ $card['gradient'][0] }}, {{ $card['gradient'][1] }}); color: white;">
                        <div class="card-body text-center">
                            <i class="fas fa-{{ $card['icon'] }} fa-3x mb-3"></i>
                            <h5 class="fw-bold text-uppercase mb-2">{{ $card['title'] }}</h5>
                            <h2 class="display-6 fw-bolder" data-target="{{ $card['value'] }}">0</h2>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="glass-card shadow-lg h-100">
                        <div class="section-header">
                            <div>
                                <span class="eyebrow text-info">Operations Snapshot</span>
                                <h4 class="mb-0 text-white">Staff Assignment Overview</h4>
                            </div>
                            <a href="{{ route('staff.create') }}" class="btn btn-sm btn-outline-light rounded-pill">Manage</a>
                        </div>

                        <div class="mini-stats">
                            <div class="mini-stat">
                                <span>Active Orders</span>
                                <strong>{{ $activeOrders }}</strong>
                            </div>
                            <div class="mini-stat">
                                <span>Unassigned</span>
                                <strong>{{ $unassignedOrders }}</strong>
                            </div>
                            <div class="mini-stat">
                                <span>Completed</span>
                                <strong>{{ $completedOrders }}</strong>
                            </div>
                        </div>

                        <div class="assignment-list">
                            @forelse ($recentAssignments as $order)
                                <div class="assignment-row">
                                    <div>
                                        <h6 class="mb-1 text-white">{{ $order->ordername }}</h6>
                                        <small class="text-light-emphasis">Customer {{ $order->customerno }} | Qty {{ $order->quantity }}</small>
                                    </div>
                                    <div class="text-end">
                                        <div class="badge rounded-pill text-bg-light text-white px-3 py-2">{{ $order->assignment_name }}</div>
                                        <small class="d-block text-light-emphasis mt-2">
                                            {{ optional($order->assigned_at)->diffForHumans() ?? 'Assigned recently' }}
                                        </small>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">
                                    <i class="fas fa-user-clock fa-2x mb-3"></i>
                                    <p class="mb-0">Abhi tak koi assigned order record nahin hai.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="glass-card shadow-lg h-100">
                        <div class="section-header">
                            <div>
                                <span class="eyebrow text-warning">Quick Actions</span>
                                <h4 class="mb-0 text-white">Fast Navigation</h4>
                            </div>
                        </div>

                        <div class="action-grid">
                            <a href="{{ route('orders.create') }}" class="action-tile">
                                <i class="fas fa-plus-circle"></i>
                                <span>Create Order</span>
                            </a>
                            <a href="{{ route('staff.create') }}" class="action-tile">
                                <i class="fas fa-user-plus"></i>
                                <span>Assign Staff</span>
                            </a>
                            <a href="{{ route('customers.index') }}" class="action-tile">
                                <i class="fas fa-address-book"></i>
                                <span>Customers</span>
                            </a>
                            <a href="{{ route('items.index') }}" class="action-tile">
                                <i class="fas fa-bowl-food"></i>
                                <span>Menu Items</span>
                            </a>
                        </div>

                        <div class="status-band mt-4">
                            <div>
                                <span class="status-label">Need attention</span>
                                <h3 class="mb-0">{{ $unassignedOrders }}</h3>
                            </div>
                            <p class="mb-0">Unassigned orders ko `Assign Orders` se turant staff ke saath map kar sakte ho.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(56, 189, 248, 0.16), transparent 30%),
                radial-gradient(circle at top right, rgba(250, 204, 21, 0.16), transparent 25%),
                linear-gradient(180deg, #08111f 0%, #0b1324 100%);
        }

        .dashboard-shell {
            min-height: calc(100vh - 80px);
        }

        .hero-panel {
            background: linear-gradient(135deg, rgba(20, 28, 48, 0.96), rgba(36, 59, 85, 0.92));
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 28px;
            overflow: hidden;
        }

        .eyebrow {
            display: inline-block;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-size: 0.78rem;
            font-weight: 700;
            color: #93c5fd;
        }

        .hero-title {
            font-size: clamp(1.8rem, 3vw, 3rem);
            font-weight: 800;
            line-height: 1.1;
        }

        .hero-copy {
            max-width: 58ch;
            color: rgba(255, 255, 255, 0.78);
        }

        .highlight-box {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 24px;
            padding: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .highlight-label,
        .status-label {
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.72rem;
            color: #fcd34d;
        }

        .highlight-number {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1;
            margin: 0.75rem 0;
        }

        .highlight-copy {
            color: rgba(255, 255, 255, 0.72);
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 24px;
            text-align: center;
        }

        .counter-card {
            width: 300px;
            min-height: 260px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .counter-card:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        }

        .glass-card {
            background: rgba(9, 18, 34, 0.82);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 26px;
            padding: 1.5rem;
            backdrop-filter: blur(12px);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .mini-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .mini-stat {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 18px;
            padding: 1rem;
            color: #dbeafe;
        }

        .mini-stat span {
            display: block;
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.66);
        }

        .mini-stat strong {
            font-size: 1.8rem;
            font-weight: 800;
        }

        .assignment-list {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        .assignment-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.1rem;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.05);
        }

        .empty-state {
            border: 1px dashed rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.72);
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }

        .action-tile {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            min-height: 150px;
            padding: 1.25rem;
            border-radius: 20px;
            text-decoration: none;
            color: white;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.22), rgba(236, 72, 153, 0.18));
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: transform 0.25s ease, border-color 0.25s ease;
        }

        .action-tile i {
            font-size: 1.8rem;
            margin-bottom: 0.75rem;
            color: #fcd34d;
        }

        .action-tile span {
            font-size: 1.05rem;
            font-weight: 700;
        }

        .action-tile:hover {
            transform: translateY(-4px);
            color: white;
            border-color: rgba(255, 255, 255, 0.24);
        }

        .status-band {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 1.1rem 1.25rem;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.22), rgba(239, 68, 68, 0.18));
            color: #fff7ed;
        }

        .btn:hover {
            transform: scale(1.03);
            filter: brightness(1.05);
        }

        @media (max-width: 991px) {
            .mini-stats,
            .action-grid {
                grid-template-columns: 1fr;
            }

            .assignment-row,
            .status-band {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 576px) {
            .counter-card {
                width: 100%;
                min-height: auto;
            }

            .hero-panel,
            .glass-card {
                border-radius: 20px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.counter-card h2[data-target]');

            counters.forEach(counter => {
                const updateCount = () => {
                    const target = Number(counter.getAttribute('data-target'));
                    const count = Number(counter.innerText);
                    const increment = Math.max(1, Math.ceil(target / 80));

                    if (count < target) {
                        counter.innerText = Math.min(target, count + increment);
                        setTimeout(updateCount, 18);
                    } else {
                        counter.innerText = target;
                    }
                };

                updateCount();
            });
        });
    </script>
</x-app-layout>
