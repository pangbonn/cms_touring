@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stats-number">1,234</div>
                    <div class="stats-label">ผู้ใช้ทั้งหมด</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card" style="background: linear-gradient(135deg, #28a745, #1e7e34);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stats-number">567</div>
                    <div class="stats-label">การจองทั้งหมด</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card" style="background: linear-gradient(135deg, #ffc107, #e0a800);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stats-number">89</div>
                    <div class="stats-label">การจองรอดำเนินการ</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card" style="background: linear-gradient(135deg, #dc3545, #c82333);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stats-number">฿45,678</div>
                    <div class="stats-label">รายได้รวม</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Bookings -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>การจองล่าสุด
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ชื่อลูกค้า</th>
                                <th>วันที่จอง</th>
                                <th>สถานะ</th>
                                <th>จำนวนเงิน</th>
                                <th>การดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#001</td>
                                <td>สมชาย ใจดี</td>
                                <td>2024-01-15</td>
                                <td><span class="badge bg-success">ยืนยันแล้ว</span></td>
                                <td>฿2,500</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>#002</td>
                                <td>สมหญิง รักดี</td>
                                <td>2024-01-14</td>
                                <td><span class="badge bg-warning">รอดำเนินการ</span></td>
                                <td>฿1,800</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>#003</td>
                                <td>วิชัย เก่งมาก</td>
                                <td>2024-01-13</td>
                                <td><span class="badge bg-danger">ยกเลิก</span></td>
                                <td>฿3,200</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>#004</td>
                                <td>มาลี สวยงาม</td>
                                <td>2024-01-12</td>
                                <td><span class="badge bg-success">ยืนยันแล้ว</span></td>
                                <td>฿2,100</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bolt me-2"></i>การดำเนินการด่วน
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>เพิ่มการจองใหม่
                    </button>
                    <button class="btn btn-outline-success">
                        <i class="fas fa-user-plus me-2"></i>เพิ่มผู้ใช้ใหม่
                    </button>
                    <button class="btn btn-outline-info">
                        <i class="fas fa-chart-bar me-2"></i>ดูรายงาน
                    </button>
                    <button class="btn btn-outline-warning">
                        <i class="fas fa-cog me-2"></i>ตั้งค่าระบบ
                    </button>
                </div>
            </div>
        </div>
        
        <!-- System Status -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-server me-2"></i>สถานะระบบ
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>ฐานข้อมูล</span>
                    <span class="badge bg-success">ปกติ</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>เซิร์ฟเวอร์</span>
                    <span class="badge bg-success">ปกติ</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>การเชื่อมต่อ</span>
                    <span class="badge bg-success">ปกติ</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>การสำรองข้อมูล</span>
                    <span class="badge bg-warning">รอดำเนินการ</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-line me-2"></i>กราฟการจองรายเดือน
                </h5>
            </div>
            <div class="card-body">
                <canvas id="bookingChart" height="300"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-pie me-2"></i>สัดส่วนการจองตามประเภท
                </h5>
            </div>
            <div class="card-body">
                <canvas id="categoryChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Booking Chart
    const bookingCtx = document.getElementById('bookingChart').getContext('2d');
    new Chart(bookingCtx, {
        type: 'line',
        data: {
            labels: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.'],
            datasets: [{
                label: 'การจอง',
                data: [12, 19, 3, 5, 2, 3],
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    // Category Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: ['ห้องประชุม', 'ห้องพัก', 'ห้องอาหาร', 'อื่นๆ'],
            datasets: [{
                data: [30, 25, 20, 25],
                backgroundColor: [
                    '#007bff',
                    '#28a745',
                    '#ffc107',
                    '#dc3545'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endpush
