<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h2 class="text-xl fw-bold text-white mb-2 mb-md-0">
                <i class="fas fa-tachometer-alt me-2 text-warning"></i> Dashboard
            </h2>
            <a href="{{ route('home') }}"
               class="btn btn-lg rounded-pill fw-semibold text-dark shadow"
               style="background: linear-gradient(135deg, #FFC371, #FF5F6D);  border-radius: 5px;">
                <i class="fas fa-home me-2"></i> Home
            </a>
        </div>
    </x-slot>

    <div class="py-5" style="background-color: #0d1117;">
        <div class="container">
            <!-- Welcome Card -->
            <div class="card mb-5 shadow-lg border-0"
                 style="background: linear-gradient(135deg, #6a11cb, #2575fc); border-radius: 20px;">
                <div class="card-body text-white d-flex align-items-center py-4">
                    <i class="fas fa-check-circle fa-2x me-3"></i>
                    <h5 class="mb-0 fw-semibold fs-5 text-center">
    You're logged in to Cafe Express Dashboard!
</h5>

                </div>
            </div>

            <!-- Stats Cards with flex and 20px gap -->
            <div class="cards-container">
                @php
                    $cards = [
                        ['title' => 'Total Customers', 'icon' => 'users', 'value' => $totalCustomers, 'gradient' => ['#ff6a00', '#ee0979']],
                        ['title' => 'Total Items', 'icon' => 'utensils', 'value' => $totalItems, 'gradient' => ['#43cea2', '#185a9d']],
                        ['title' => 'Total Orders', 'icon' => 'receipt', 'value' => $totalOrders, 'gradient' => ['#00b09b', '#96c93d']],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="counter-card d-flex flex-column justify-content-center align-items-center shadow-lg border-0"
                         style="border-radius: 20px; background: linear-gradient(135deg, {{ $card['gradient'][0] }}, {{ $card['gradient'][1] }}); color: white;">
                        <div class="card-body text-center">
                            <i class="fas fa-{{ $card['icon'] }} fa-3x mb-3"></i>
                            <h5 class="fw-bold text-uppercase mb-2">{{ $card['title'] }}</h5>
                            <h2 class="display-6 fw-bolder" data-target="{{ $card['value'] }}">0</h2>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #0d1117;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            text-align: center;
        }

        .counter-card {
            width: 300px;
            height: 300px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        @media (max-width: 576px) {
            .counter-card {
                width: 90vw;
                height: auto;
            }
        }

        .counter-card:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        }

        .btn:hover {
            transform: scale(1.03);
            filter: brightness(1.05);
        }
    </style>

    <script>
        // Animate counters on page load
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.counter-card h2[data-target]');
            
            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText;
                    const increment = target / 200; // Adjust speed
                    
                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(updateCount, 10);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            });
        });
    </script>
</x-app-layout>
