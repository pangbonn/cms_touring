@extends('layouts.daisyui')

@section('title', 'จัดการเงื่อนไขการจอง')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-base-content">จัดการเงื่อนไขการจอง</h1>
            <p class="text-base-content/70 mt-1">จัดการเงื่อนไขและข้อกำหนดการจองทริป</p>
        </div>
        <div class="flex gap-2">
            <button onclick="createDefaultTerms()" class="btn btn-outline">
                <i class="fas fa-magic mr-2"></i>
                สร้างเงื่อนไขเริ่มต้น
            </button>
            <button onclick="openAddTermModal()" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>
                เพิ่มเงื่อนไขใหม่
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="stat bg-base-100 rounded-lg shadow">
            <div class="stat-figure text-primary">
                <i class="fas fa-file-contract text-2xl"></i>
            </div>
            <div class="stat-title">เงื่อนไขทั้งหมด</div>
            <div class="stat-value text-primary">{{ $terms->total() }}</div>
        </div>
        
        <div class="stat bg-base-100 rounded-lg shadow">
            <div class="stat-figure text-success">
                <i class="fas fa-check-circle text-2xl"></i>
            </div>
            <div class="stat-title">เงื่อนไขที่เปิดใช้งาน</div>
            <div class="stat-value text-success">{{ $terms->where('is_active', true)->count() }}</div>
        </div>
        
        <div class="stat bg-base-100 rounded-lg shadow">
            <div class="stat-figure text-error">
                <i class="fas fa-exclamation-triangle text-2xl"></i>
            </div>
            <div class="stat-title">เงื่อนไขบังคับ</div>
            <div class="stat-value text-error">{{ $terms->where('is_required', true)->count() }}</div>
        </div>
        
        <div class="stat bg-base-100 rounded-lg shadow">
            <div class="stat-figure text-info">
                <i class="fas fa-tags text-2xl"></i>
            </div>
            <div class="stat-title">หมวดหมู่</div>
            <div class="stat-value text-info">{{ $terms->pluck('term_category')->unique()->count() }}</div>
        </div>
    </div>

    <!-- Terms Table -->
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>หัวข้อเงื่อนไข</th>
                            <th>หมวดหมู่</th>
                            <th>สถานะ</th>
                            <th>บังคับ</th>
                            <th>การดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($terms as $term)
                        <tr>
                            <td>
                                <div class="font-semibold">{{ $term->sort_order }}</div>
                            </td>
                            <td>
                                <div class="font-semibold">{{ $term->term_title }}</div>
                                <div class="text-sm text-base-content/70">{{ Str::limit($term->term_content, 80) }}</div>
                            </td>
                            <td>
                                <div class="badge {{ $term->category_badge_class }}">
                                    {{ $term->category_label }}
                                </div>
                            </td>
                            <td>
                                <div class="badge {{ $term->status_badge_class }}">
                                    @if($term->is_active)
                                        <i class="fas fa-check-circle mr-1"></i>เปิดใช้งาน
                                    @else
                                        <i class="fas fa-times-circle mr-1"></i>ปิดใช้งาน
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="badge {{ $term->required_badge_class }}">
                                    @if($term->is_required)
                                        <i class="fas fa-exclamation-triangle mr-1"></i>บังคับ
                                    @else
                                        <i class="fas fa-info-circle mr-1"></i>ไม่บังคับ
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <button onclick="openTermDetailModal({{ $term->id }})" 
                                            class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="openEditTermModal({{ $term->id }})" 
                                            class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="toggleTermStatus({{ $term->id }}, {{ $term->is_active ? 'true' : 'false' }})" 
                                            class="btn btn-sm {{ $term->is_active ? 'btn-error' : 'btn-success' }}">
                                        <i class="fas fa-{{ $term->is_active ? 'times' : 'check' }}"></i>
                                    </button>
                                    <button onclick="toggleTermRequired({{ $term->id }}, {{ $term->is_required ? 'true' : 'false' }})" 
                                            class="btn btn-sm {{ $term->is_required ? 'btn-outline' : 'btn-error' }}">
                                        <i class="fas fa-{{ $term->is_required ? 'unlock' : 'lock' }}"></i>
                                    </button>
                                    <button onclick="deleteTerm({{ $term->id }})" 
                                            class="btn btn-sm btn-error">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-8">
                                <div class="text-base-content/50">
                                    <i class="fas fa-file-contract text-4xl mb-4"></i>
                                    <p>ยังไม่มีเงื่อนไขการจอง</p>
                                    <button onclick="createDefaultTerms()" class="btn btn-primary btn-sm mt-2">
                                        <i class="fas fa-magic mr-1"></i>
                                        สร้างเงื่อนไขเริ่มต้น
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($terms->hasPages())
            <div class="flex justify-center mt-6">
                {{ $terms->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Term Detail Modal -->
<dialog id="termDetailModal" class="modal">
    <div class="modal-box max-w-4xl">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg mb-4">รายละเอียดเงื่อนไขการจอง</h3>
        <div id="termDetailContent">
            <!-- Content will be loaded here -->
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Add Term Modal -->
<dialog id="addTermModal" class="modal">
    <div class="modal-box max-w-4xl">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg mb-4">เพิ่มเงื่อนไขการจองใหม่</h3>
        
        <form id="addTermForm">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">หัวข้อเงื่อนไข</span>
                        </label>
                        <input type="text" name="term_title" class="input input-bordered w-full" required>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">หมวดหมู่</span>
                        </label>
                        <select name="term_category" class="select select-bordered w-full" required>
                            @foreach($categoryOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">ลำดับการแสดง</span>
                        </label>
                        <input type="number" name="sort_order" min="0" max="999" value="0" class="input input-bordered w-full">
                        <div class="label">
                            <span class="label-text-alt">ตัวเลขน้อย = แสดงก่อน</span>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text font-semibold">เปิดใช้งานทันที</span>
                            <input type="checkbox" name="is_active" class="checkbox checkbox-primary" checked>
                        </label>
                    </div>

                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text font-semibold">เป็นเงื่อนไขบังคับ</span>
                            <input type="checkbox" name="is_required" class="checkbox checkbox-error">
                        </label>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">เนื้อหาเงื่อนไข</span>
                        </label>
                        <textarea name="term_content" rows="6" class="textarea textarea-bordered w-full" required placeholder="ระบุเนื้อหาเงื่อนไขการจอง..."></textarea>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">ข้อมูลเพิ่มเติม</span>
                        </label>
                        <textarea name="additional_info" rows="3" class="textarea textarea-bordered w-full" placeholder="ข้อมูลเพิ่มเติมหรือคำแนะนำ..."></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-outline">ยกเลิก</button>
                </form>
                <button type="submit" class="btn btn-primary">บันทึกเงื่อนไข</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Edit Term Modal -->
<dialog id="editTermModal" class="modal">
    <div class="modal-box max-w-4xl">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg mb-4">แก้ไขเงื่อนไขการจอง</h3>
        
        <form id="editTermForm">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">หัวข้อเงื่อนไข</span>
                        </label>
                        <input type="text" name="term_title" class="input input-bordered w-full" required>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">หมวดหมู่</span>
                        </label>
                        <select name="term_category" class="select select-bordered w-full" required>
                            @foreach($categoryOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">ลำดับการแสดง</span>
                        </label>
                        <input type="number" name="sort_order" min="0" max="999" class="input input-bordered w-full">
                    </div>

                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text font-semibold">เปิดใช้งาน</span>
                            <input type="checkbox" name="is_active" class="checkbox checkbox-primary">
                        </label>
                    </div>

                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text font-semibold">เป็นเงื่อนไขบังคับ</span>
                            <input type="checkbox" name="is_required" class="checkbox checkbox-error">
                        </label>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">เนื้อหาเงื่อนไข</span>
                        </label>
                        <textarea name="term_content" rows="6" class="textarea textarea-bordered w-full" required></textarea>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">ข้อมูลเพิ่มเติม</span>
                        </label>
                        <textarea name="additional_info" rows="3" class="textarea textarea-bordered w-full"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-outline">ยกเลิก</button>
                </form>
                <button type="submit" class="btn btn-primary">อัปเดตเงื่อนไข</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<!-- Confirm Actions Modal -->
<dialog id="confirmActionModal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">ยืนยันการดำเนินการ</h3>
        <p id="confirmActionMessage" class="mb-4"></p>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn btn-outline">ยกเลิก</button>
            </form>
            <button id="confirmActionBtn" class="btn btn-primary">ยืนยัน</button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
@endsection

@push('scripts')
<script>
// Global variables
let currentTermId = null;
let currentAction = null;

// Show DaisyUI alert
function showAlert(message, type = 'info') {
    // Remove existing alerts
    const existingAlerts = document.querySelectorAll('.alert-toast');
    existingAlerts.forEach(alert => alert.remove());
    
    // Create new alert
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-toast fixed top-4 right-4 z-50 max-w-sm`;
    alertDiv.innerHTML = `
        <div>
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
            <span>${message}</span>
        </div>
        <button class="btn btn-sm btn-ghost" onclick="this.parentElement.remove()">✕</button>
    `;
    
    document.body.appendChild(alertDiv);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentElement) {
            alertDiv.remove();
        }
    }, 5000);
}

// Modal functions
function openAddTermModal() {
    document.getElementById('addTermModal').showModal();
}

function openEditTermModal(termId) {
    currentTermId = termId;
    document.getElementById('editTermModal').showModal();
    loadTermData(termId);
}

function openTermDetailModal(termId) {
    document.getElementById('termDetailModal').showModal();
    loadTermDetail(termId);
}

function toggleTermStatus(termId, isActive) {
    currentTermId = termId;
    currentAction = 'toggleStatus';
    
    const message = isActive 
        ? 'คุณต้องการปิดใช้เงื่อนไขนี้หรือไม่?' 
        : 'คุณต้องการเปิดใช้เงื่อนไขนี้หรือไม่?';
    
    document.getElementById('confirmActionMessage').textContent = message;
    document.getElementById('confirmActionModal').showModal();
}

function toggleTermRequired(termId, isRequired) {
    currentTermId = termId;
    currentAction = 'toggleRequired';
    
    const message = isRequired 
        ? 'คุณต้องการยกเลิกเงื่อนไขบังคับนี้หรือไม่?' 
        : 'คุณต้องการตั้งเงื่อนไขนี้เป็นบังคับหรือไม่?';
    
    document.getElementById('confirmActionMessage').textContent = message;
    document.getElementById('confirmActionModal').showModal();
}

function deleteTerm(termId) {
    currentTermId = termId;
    currentAction = 'delete';
    
    document.getElementById('confirmActionMessage').textContent = 'คุณต้องการลบเงื่อนไขนี้หรือไม่?';
    document.getElementById('confirmActionModal').showModal();
}

function createDefaultTerms() {
    if (!confirm('คุณต้องการสร้างเงื่อนไขเริ่มต้นหรือไม่?')) return;
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) {
        showAlert('ไม่พบ CSRF token กรุณารีเฟรชหน้าเว็บ', 'error');
        return;
    }
    
    fetch('/booking-terms/create-default', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(data.message, 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showAlert(data.message || 'เกิดข้อผิดพลาด', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ', 'error');
    });
}

function performAction() {
    if (!currentTermId || !currentAction) return;
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) {
        showAlert('ไม่พบ CSRF token กรุณารีเฟรชหน้าเว็บ', 'error');
        return;
    }
    
    let url = '';
    let method = 'PATCH';
    
    switch(currentAction) {
        case 'toggleStatus':
            url = `/booking-terms/${currentTermId}/toggle-status`;
            break;
        case 'toggleRequired':
            url = `/booking-terms/${currentTermId}/toggle-required`;
            break;
        case 'delete':
            url = `/booking-terms/${currentTermId}`;
            method = 'DELETE';
            break;
    }
    
    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(data.message, 'success');
            document.getElementById('confirmActionModal').close();
            setTimeout(() => location.reload(), 1500);
        } else {
            showAlert(data.message || 'เกิดข้อผิดพลาด', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ', 'error');
    });
}

// Load functions
function loadTermData(termId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) {
        showAlert('ไม่พบ CSRF token กรุณารีเฟรชหน้าเว็บ', 'error');
        return;
    }
    
    fetch(`/booking-terms/${termId}/details`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.term) {
            const term = data.term;
            
            // Fill form fields
            document.querySelector('#editTermForm input[name="term_title"]').value = term.term_title;
            document.querySelector('#editTermForm select[name="term_category"]').value = term.term_category;
            document.querySelector('#editTermForm textarea[name="term_content"]').value = term.term_content;
            document.querySelector('#editTermForm input[name="sort_order"]').value = term.sort_order;
            document.querySelector('#editTermForm input[name="is_active"]').checked = term.is_active;
            document.querySelector('#editTermForm input[name="is_required"]').checked = term.is_required;
            document.querySelector('#editTermForm textarea[name="additional_info"]').value = term.additional_info || '';
            
        } else {
            showAlert('ไม่สามารถโหลดข้อมูลได้', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('เกิดข้อผิดพลาดในการโหลดข้อมูล', 'error');
    });
}

function loadTermDetail(termId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) {
        showAlert('ไม่พบ CSRF token กรุณารีเฟรชหน้าเว็บ', 'error');
        return;
    }
    
    // Show loading
    document.getElementById('termDetailContent').innerHTML = `
        <div class="text-center py-8">
            <i class="fas fa-spinner fa-spin text-2xl mb-4"></i>
            <p>กำลังโหลดข้อมูล...</p>
        </div>
    `;
    
    fetch(`/booking-terms/${termId}/details`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.term) {
            const term = data.term;
            document.getElementById('termDetailContent').innerHTML = `
                <div class="space-y-6">
                    <!-- Term Header -->
                    <div class="card bg-base-200">
                        <div class="card-body">
                            <div class="flex items-center justify-between">
                                <h4 class="card-title">${term.term_title}</h4>
                                <div class="flex gap-2">
                                    <div class="badge ${term.category_badge_class}">${term.category_label}</div>
                                    <div class="badge ${term.status_badge_class}">${term.status_label}</div>
                                    <div class="badge ${term.required_badge_class}">${term.required_label}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Term Content -->
                    <div class="card bg-base-100">
                        <div class="card-body">
                            <h5 class="font-semibold mb-3">เนื้อหาเงื่อนไข</h5>
                            <div class="text-sm whitespace-pre-line">${term.term_content}</div>
                        </div>
                    </div>
                    
                    ${term.additional_info ? `
                    <!-- Additional Info -->
                    <div class="card bg-base-100">
                        <div class="card-body">
                            <h5 class="font-semibold mb-3">ข้อมูลเพิ่มเติม</h5>
                            <div class="text-sm whitespace-pre-line">${term.additional_info}</div>
                        </div>
                    </div>
                    ` : ''}
                    
                    <!-- Term Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="card bg-base-100">
                            <div class="card-body">
                                <h5 class="font-semibold mb-3">ข้อมูลเงื่อนไข</h5>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-base-content/70">ลำดับการแสดง:</span>
                                        <span class="font-medium">${term.sort_order}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-base-content/70">ผู้สร้าง:</span>
                                        <span class="font-medium">${term.creator.first_name} ${term.creator.last_name}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-base-content/70">วันที่สร้าง:</span>
                                        <span class="font-medium">${new Date(term.created_at).toLocaleDateString('th-TH')}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-base-content/70">อัปเดตล่าสุด:</span>
                                        <span class="font-medium">${new Date(term.updated_at).toLocaleDateString('th-TH')}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        } else {
            document.getElementById('termDetailContent').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-circle text-2xl mb-4 text-error"></i>
                    <p>ไม่สามารถโหลดข้อมูลได้</p>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('termDetailContent').innerHTML = `
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-2xl mb-4 text-error"></i>
                <p>เกิดข้อผิดพลาดในการโหลดข้อมูล</p>
            </div>
        `;
    });
}

// Form submissions
document.getElementById('addTermForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    if (!csrfToken) {
        showAlert('ไม่พบ CSRF token กรุณารีเฟรชหน้าเว็บ', 'error');
        return;
    }
    
    fetch('/booking-terms', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(data.message, 'success');
            document.getElementById('addTermModal').close();
            setTimeout(() => location.reload(), 1500);
        } else {
            showAlert(data.message || 'เกิดข้อผิดพลาด', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ', 'error');
    });
});

document.getElementById('editTermForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    if (!csrfToken) {
        showAlert('ไม่พบ CSRF token กรุณารีเฟรชหน้าเว็บ', 'error');
        return;
    }
    
    formData.set('_method', 'PUT');
    
    fetch(`/booking-terms/${currentTermId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(data.message, 'success');
            document.getElementById('editTermModal').close();
            setTimeout(() => location.reload(), 1500);
        } else {
            showAlert(data.message || 'เกิดข้อผิดพลาด', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('เกิดข้อผิดพลาดในการเชื่อมต่อ', 'error');
    });
});

// Event listeners
document.getElementById('confirmActionBtn').addEventListener('click', function() {
    performAction();
});
</script>
@endpush
