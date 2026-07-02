@extends('dash.master_dash')
@section('content')

    <style>
        /* تنسيق شبكة البطاقات الإحصائية */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* تصميم بطاقات الـ Glow Tech النيونية */
        .stat-card {
            background: #141414 !important;
            border: 1px solid var(--border-color) !important;
            border-radius: var(--radius-lg) !important;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.25rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 20px rgba(0, 255, 135, 0.15);
        }

        /* تصميم الأيقونات داخل البطاقات */
        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        /* توزيع الألوان المتوهجة بنظام النيون */
        .stat-icon.blue {
            background: rgba(0, 180, 216, 0.1);
            color: #00b4d8;
            border: 1px solid rgba(0, 180, 216, 0.2);
        }
        .stat-card:hover .stat-icon.blue { box-shadow: 0 0 15px rgba(0, 180, 216, 0.4); }

        .stat-icon.green {
            background: rgba(0, 255, 135, 0.1);
            color: var(--primary-color);
            border: 1px solid rgba(0, 255, 135, 0.2);
        }
        .stat-card:hover .stat-icon.green { box-shadow: 0 0 15px rgba(0, 255, 135, 0.4); }

        .stat-icon.purple {
            background: rgba(157, 78, 221, 0.1);
            color: #9d4ede;
            border: 1px solid rgba(157, 78, 221, 0.2);
        }
        .stat-card:hover .stat-icon.purple { box-shadow: 0 0 15px rgba(157, 78, 221, 0.4); }

        .stat-icon.orange {
            background: rgba(255, 159, 67, 0.1);
            color: #ff9f43;
            border: 1px solid rgba(255, 159, 67, 0.2);
        }
        .stat-card:hover .stat-icon.orange { box-shadow: 0 0 15px rgba(255, 159, 67, 0.4); }

        /* نصوص البطاقات الإحصائية */
        .stat-info h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-color);
            margin: 0 0 0.25rem 0;
        }

        .stat-info p {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* تنسيق مساحة الرسم البياني لتصبح داكنة ومتناسقة */
        .chart-card {
            background: #141414 !important;
            border: 1px solid var(--border-color) !important;
            border-radius: var(--radius-lg) !important;
            padding: 2rem;
            margin-top: 2rem;
        }

        .chart-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .chart-title i {
            color: var(--primary-color);
        }

        .chart-wrapper {
            position: relative;
            width: 100%;
            max-height: 400px;
        }
    </style>

    <div class="content-wrapper">
        <div class="page-header mb-4">
            <h1 class="page-title fw-bold" style="color: var(--text-color);">Dashboard Overview</h1>
        </div>

        <div class="stats-grid">
            <div class="card stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-info">
                    <h3>{{$ordersCount}}</h3>
                    <p>Total Order</p>
                </div>
            </div>
            
            

            <div class="card stat-card">
                <div class="stat-icon purple">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="stat-info">
                    <h3>{{$productsCount}}</h3>
                    <p>Total Products</p>
                </div>
            </div>

            <div class="card stat-card">
                <div class="stat-icon orange">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>{{$usersCount}}</h3>
                    <p>Total Users</p>
                </div>
            </div>
        </div>

        <div class="card chart-card">
            <div class="chart-title">
                <i class="fas fa-chart-bar"></i> Traffic & Orders Analytics
            </div>
            <div class="chart-wrapper">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('ordersChart');
            
            // جلب الألوان الأساسية من الـ CSS Variables الخاصة بالنظام لديك لضمان التناسق المطلق
            const primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--primary-color').trim() || '#00ff87';

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Orders',
                        data: @json($data),
                        backgroundColor: 'rgba(0, 255, 135, 0.15)', // لون نيون شفاف لأعمدة الرسم البياني
                        borderColor: primaryColor, // الحدود النيون المتوهجة
                        borderWidth: 2,
                        borderRadius: 6, // زوايا دائرية ناعمة للأعمدة
                        hoverBackgroundColor: primaryColor, // تحول العمود للون الكامل عند مرور الماوس
                        hoverBorderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: '#888888', // لون خط التوضيح علوي
                                font: { family: 'Inter, sans-serif', size: 12 }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)' // خطوط شبكة أفقية باهتة ومريحة للعين
                            },
                            ticks: {
                                color: '#888888'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)'
                            },
                            ticks: {
                                color: '#888888',
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection