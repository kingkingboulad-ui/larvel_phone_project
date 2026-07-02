@extends('web.master')
@section('content')


 
<style>
    body {
        background-color: #121212;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    /* كروت الحاوية */
    .profile-card {
        background-color: #1c1c1c;
        border-radius: 12px;
        padding: 25px;
        border: none;
    }
    /* الصورة الشخصية والـ Avatar */
    .avatar-container {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto;
    }
    .avatar-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #00ff87;
    }
    .edit-avatar-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: #00ff87;
        color: #121212;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: 0.3s;
    }
    .edit-avatar-btn:hover {
        background-color: #00d66f;
        transform: scale(1.1);
    }
    /* القائمة الجانبية للملف */
    .profile-menu a {
        color: #aaa;
        transition: 0.3s;
        border-radius: 8px;
    }
    .profile-menu a:hover, .profile-menu a.active {
        color: #00ff87 !important;
        background-color: rgba(0, 255, 135, 0.05);
    }
    /* أزرار مخصصة */
    .btn-neon {
        background-color: #00ff87;
        color: #121212;
        font-weight: bold;
        border-radius: 6px;
        transition: 0.3s;
        border: none;
    }
    .btn-neon:hover {
        background-color: #00d66f;
        color: #121212;
        box-shadow: 0 0 10px rgba(0, 255, 135, 0.4);
    }
    .btn-outline-neon {
        border: 1px solid #00ff87;
        color: #00ff87;
        font-weight: bold;
        border-radius: 6px;
        transition: 0.3s;
        background: transparent;
    }
    .btn-outline-neon:hover {
        background-color: #00ff87;
        color: #121212;
    }
    /* الحقول والجداول */
    .form-control {
        background-color: #252525 !important;
        border: 1px solid #333 !important;
        color: white !important;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 255, 135, 0.25);
        border-color: #00ff87;
    }
    .table {
        color: white !important;
    }
    .table th {
        border-color: #333;
        color: #aaa;
    }
    .table td {
        border-color: #252525;
        vertical-align: middle;
    }
    /* شارات الحالة للطلبات */
    .badge-status {
        font-size: 0.75rem;
        padding: 6px 12px;
        border-radius: 30px;
        font-weight: 600;
    }
    .status-delivered { background-color: rgba(25, 135, 84, 0.2); color: #198754; }
    .status-pending { background-color: rgba(255, 193, 7, 0.2); color: #ffc107; }
</style> 
    <div class="container my-5">
        <div class="row g-4">
            
            <div class="col-lg-4">
                <div class="card profile-card text-center">
                    <div class="avatar-container mb-3">
                        <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&auto=format&fit=crop&q=80" alt="User Avatar">
                        <button class="edit-avatar-btn" title="Change Avatar">
                            <i class="bi bi-camera-fill"></i>
                        </button>
                    </div>
                    <h5 class="fw-bold mb-1">John Doe</h5>
                    <p class="text-secondary small mb-4">Member since Oct 2023</p>
                    
                    <hr style="border-color: #333;">
                    
                    <div class="profile-menu list-group list-group-flush text-start border-0">
                        <a href="#" class="list-group-item list-group-item-action bg-transparent border-0 py-3 active">
                            <i class="bi bi-person-gear me-3"></i>Account Settings
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-transparent border-0 py-3">
                            <i class="bi bi-clock-history me-3"></i>Order History
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-transparent border-0 py-3">
                            <i class="bi bi-geo-alt me-3"></i>Saved Addresses
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-transparent border-0 py-3 text-danger">
                            <i class="bi bi-box-arrow-left me-3"></i>Logout
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card profile-card mb-4">
                    <h5 class="fw-bold mb-4 text-uppercase" style="letter-spacing: 0.5px;">
                        <span style="color: #00ff87;">Personal</span> Information
                    </h5>
                    
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Full Name</label>
                                <input type="text" class="form-control" value="John Doe">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Email Address</label>
                                <input type="email" class="form-control" value="johndoe@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Phone Number</label>
                                <input type="tel" class="form-control" value="+1 (555) 019-2834">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Location / Country</label>
                                <input type="text" class="form-control" value="New York, USA">
                            </div>
                            <div class="col-12">
                                <label class="form-label text-secondary small">Shipping Address</label>
                                <input type="text" class="form-control" value="123 Neon Street, Manhattan, NY 10001">
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-neon px-4 py-2">Save Changes</button>
                            <button type="button" class="btn btn-outline-neon px-4 py-2">Cancel</button>
                        </div>
                    </form>
                </div>

                <div class="card profile-card">
                    <h5 class="fw-bold mb-4 text-uppercase" style="letter-spacing: 0.5px;">
                        <span style="color: #00ff87;">Recent</span> Orders
                    </h5>
                    
                    <div class="table-responsive">
                        <table class="table table-dark bg-transparent mb-0">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold">#PS-9482</td>
                                    <td class="small text-secondary">Jun 14, 2026</td>
                                    <td style="color: #00ff87;" class="fw-bold">$1,099</td>
                                    <td><span class="badge-status status-delivered">Delivered</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">#PS-9211</td>
                                    <td class="small text-secondary">May 28, 2026</td>
                                    <td style="color: #00ff87;" class="fw-bold">$149</td>
                                    <td><span class="badge-status status-delivered">Delivered</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">#PS-8954</td>
                                    <td class="small text-secondary">Just Now</td>
                                    <td style="color: #00ff87;" class="fw-bold">$399</td>
                                    <td><span class="badge-status status-pending">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>






@endsection
















