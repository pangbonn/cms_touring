@extends('layouts.daisyui')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<style>
    .stat {
        background-color: white;
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }
    
    .stat-primary {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
    }
    
    .stat-secondary {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }
    
    .stat-accent {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }
    
    .stat-success {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: white;
    }
    
    .card {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .table th,
    .table td {
        padding: 0.75rem;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .table th {
        background-color: #f9fafb;
        font-weight: 600;
        color: #374151;
    }
    
    .badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .badge-success {
        background-color: #dcfce7;
        color: #166534;
    }
    
    .badge-warning {
        background-color: #fef3c7;
        color: #92400e;
    }
    
    .badge-error {
        background-color: #fee2e2;
        color: #991b1b;
    }
    
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s;
        border: 1px solid transparent;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-primary {
        background-color: #3b82f6;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #2563eb;
    }
    
    .btn-outline {
        background-color: transparent;
        border-color: #d1d5db;
        color: #374151;
    }
    
    .btn-outline:hover {
        background-color: #f9fafb;
    }
    
    .btn-sm {
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
    }
    
    .btn-xs {
        padding: 0.125rem 0.5rem;
        font-size: 0.75rem;
    }
    
    .btn-ghost {
        background-color: transparent;
        color: #6b7280;
    }
    
    .btn-ghost:hover {
        background-color: #f3f4f6;
    }
</style>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users -->
    <div class="stat stat-primary">
        <div class="flex justify-between items-center">
            <div>
                <div class="text-sm opacity-80">ผู้ใช้ทั้งหมด</div>
                <div class="text-3xl font-bold">1,234</div>
                <div class="text-sm opacity-80">+12% จากเดือนที่แล้ว</div>
            </div>
            <div class="text-4xl opacity-80">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    
    <!-- Total Bookings -->
    <div class="stat stat-secondary">
        <div class="flex justify-between items-center">
            <div>
                <div class="text-sm opacity-80">การจองทั้งหมด</div>
                <div class="text-3xl font-bold">567</div>
                <div class="text-sm opacity-80">+8% จากเดือนที่แล้ว</div>
            </div>
            <div class="text-4xl opacity-80">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>
    
    <!-- Pending Bookings -->
    <div class="stat stat-accent">
        <div class="flex justify-between items-center">
            <div>
                <div class="text-sm opacity-80">รอดำเนินการ</div>
                <div class="text-3xl font-bold">89</div>
                <div class="text-sm opacity-80">-5% จากเดือนที่แล้ว</div>
            </div>
            <div class="text-4xl opacity-80">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>
    
    <!-- Total Revenue -->
    <div class="stat stat-success">
        <div class="flex justify-between items-center">
            <div>
                <div class="text-sm opacity-80">รายได้รวม</div>
                <div class="text-3xl font-bold">฿45,678</div>
                <div class="text-sm opacity-80">+15% จากเดือนที่แล้ว</div>
            </div>
            <div class="text-4xl opacity-80">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Bookings Table -->
    <div class="lg:col-span-2">
        <div class="card">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-calendar-alt text-blue-600"></i>
                    การจองล่าสุด
                </h2>
                <button class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>
                    เพิ่มใหม่
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ลูกค้า</th>
                            <th>วันที่</th>
                            <th>สถานะ</th>
                            <th>จำนวนเงิน</th>
                            <th>การดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="font-mono">#001</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold">สมชาย ใจดี</div>
                                        <div class="text-sm text-gray-500">somchai@email.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>2024-01-15</td>
                            <td>
                                <div class="badge badge-success">
                                    <i class="fas fa-check me-1"></i>
                                    ยืนยันแล้ว
                                </div>
                            </td>
                            <td class="font-bold">฿2,500</td>
                            <td>
                                <button class="btn btn-ghost btn-xs">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-mono">#002</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-green-600 text-white flex items-center justify-center">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold">สมหญิง รักดี</div>
                                        <div class="text-sm text-gray-500">somying@email.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>2024-01-14</td>
                            <td>
                                <div class="badge badge-warning">
                                    <i class="fas fa-clock me-1"></i>
                                    รอดำเนินการ
                                </div>
                            </td>
                            <td class="font-bold">฿1,800</td>
                            <td>
                                <button class="btn btn-ghost btn-xs">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-mono">#003</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-orange-600 text-white flex items-center justify-center">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold">วิชัย เก่งมาก</div>
                                        <div class="text-sm text-gray-500">wichai@email.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>2024-01-13</td>
                            <td>
                                <div class="badge badge-error">
                                    <i class="fas fa-times me-1"></i>
                                    ยกเลิก
                                </div>
                            </td>
                            <td class="font-bold">฿3,200</td>
                            <td>
                                <button class="btn btn-ghost btn-xs">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="card">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                <i class="fas fa-bolt text-blue-600"></i>
                การดำเนินการด่วน
            </h2>
            <div class="space-y-2">
                <button class="btn btn-primary w-full justify-start">
                    <i class="fas fa-plus me-2"></i>
                    เพิ่มการจองใหม่
                </button>
                <button class="btn btn-outline w-full justify-start">
                    <i class="fas fa-user-plus me-2"></i>
                    เพิ่มผู้ใช้ใหม่
                </button>
                <button class="btn btn-outline w-full justify-start">
                    <i class="fas fa-chart-bar me-2"></i>
                    ดูรายงาน
                </button>
                <button class="btn btn-outline w-full justify-start">
                    <i class="fas fa-cog me-2"></i>
                    ตั้งค่าระบบ
                </button>
            </div>
        </div>
        
        <!-- System Status -->
        <div class="card">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                <i class="fas fa-server text-blue-600"></i>
                สถานะระบบ
            </h2>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">ฐานข้อมูล</span>
                    <div class="badge badge-success">
                        <div class="w-2 h-2 bg-green-600 rounded-full me-1"></div>
                        ปกติ
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">เซิร์ฟเวอร์</span>
                    <div class="badge badge-success">
                        <div class="w-2 h-2 bg-green-600 rounded-full me-1"></div>
                        ปกติ
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">การเชื่อมต่อ</span>
                    <div class="badge badge-success">
                        <div class="w-2 h-2 bg-green-600 rounded-full me-1"></div>
                        ปกติ
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">การสำรองข้อมูล</span>
                    <div class="badge badge-warning">
                        <div class="w-2 h-2 bg-yellow-600 rounded-full me-1"></div>
                        รอดำเนินการ
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="card">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                <i class="fas fa-history text-blue-600"></i>
                กิจกรรมล่าสุด
            </h2>
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center">
                        <i class="fas fa-user text-xs"></i>
                    </div>
                    <div class="text-sm">
                        <div class="font-semibold text-gray-800">ผู้ใช้ใหม่ลงทะเบียน</div>
                        <div class="text-xs text-gray-500">2 นาทีที่แล้ว</div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center">
                        <i class="fas fa-calendar text-xs"></i>
                    </div>
                    <div class="text-sm">
                        <div class="font-semibold text-gray-800">การจองใหม่</div>
                        <div class="text-xs text-gray-500">5 นาทีที่แล้ว</div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-orange-600 text-white flex items-center justify-center">
                        <i class="fas fa-check text-xs"></i>
                    </div>
                    <div class="text-sm">
                        <div class="font-semibold text-gray-800">การจองได้รับการยืนยัน</div>
                        <div class="text-xs text-gray-500">10 นาทีที่แล้ว</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
    <!-- Booking Chart -->
    <div class="card">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-chart-line text-blue-600"></i>
            กราฟการจองรายเดือน
        </h2>
        <div class="h-64 flex items-center justify-center bg-gray-100 rounded-lg">
            <div class="text-center">
                <i class="fas fa-chart-line text-6xl text-gray-400 mb-4"></i>
                <p class="text-gray-500">กราฟจะแสดงที่นี่</p>
            </div>
        </div>
    </div>
    
    <!-- Category Chart -->
    <div class="card">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-chart-pie text-blue-600"></i>
            สัดส่วนการจองตามประเภท
        </h2>
        <div class="h-64 flex items-center justify-center bg-gray-100 rounded-lg">
            <div class="text-center">
                <i class="fas fa-chart-pie text-6xl text-gray-400 mb-4"></i>
                <p class="text-gray-500">กราฟจะแสดงที่นี่</p>
            </div>
        </div>
    </div>
</div>
@endsection