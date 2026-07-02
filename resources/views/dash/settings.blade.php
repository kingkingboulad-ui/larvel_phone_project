@extends('dash.master_dash')

@section('content')
<div class="content-wrapper py-4 px-2">
    <div class="page-header mb-4">
        <h1 class="page-title fw-bold text-white">General Settings</h1>
        <p class=" small">Manage your phone store configuration, branding, and social links.</p>
    </div>

    <!-- عرض رسائل النجاح أو الأخطاء إذا وجدت -->
    @if(session('success'))
        <div class="alert alert-success-custom mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- القسم الأول: معلومات الموقع الأساسية -->
        <div class="custom-card mb-4">
            <div class="card-title-wrapper mb-4">
                <i class="fas fa-info-circle section-icon"></i>
                <h3 class="mb-0">Site Information</h3>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-custom">Site Name</label>
                        <input type="text" name="site_name" class="form-control-custom" 
                               value="{{ old('site_name', $setting->site_name ?? '') }}" placeholder="e.g. Phone Store Premium">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-custom">Admin Email</label>
                        <input type="email" name="email" class="form-control-custom" 
                               value="{{ old('email', $setting->email ?? '') }}" placeholder="admin@example.com">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-custom">Phone Number</label>
                        <input type="text" name="phone" class="form-control-custom" 
                               value="{{ old('phone', $setting->phone ?? '') }}" placeholder="+123456789">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-custom">Address</label>
                        <input type="text" name="address" class="form-control-custom" 
                               value="{{ old('address', $setting->address ?? '') }}" placeholder="City, Country">
                    </div>
                </div>
            </div>
        </div>

        <!-- القسم الثاني: المظهر والبراندينج المتناسق مع الثيم -->
        <div class="custom-card mb-4">
            <div class="card-title-wrapper mb-4">
                <i class="fas fa-paint-brush section-icon"></i>
                <h3 class="mb-0">Appearance & Branding</h3>
            </div>
            
            <div class="row g-4">
                <!-- تخصيص عينات الألوان التفاعلية الافتراضية للمتجر الداكن -->
                <div class="col-md-4">
                    <div class="form-group-custom">
                        <label class="form-label-custom">Primary Color Toggle</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="color" value="#00ff87"
                                   onchange="document.documentElement.style.setProperty('--primary-color', this.value)"
                                   class="color-picker-custom">
                            <span class="text-muted small">Live Preview Sync</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-custom">
                        <label class="form-label-custom">Logo File</label>
                        <input type="file" name="logo" class="form-control-custom file-input">
                        @if(!empty($setting->logo))
                            <div class="mt-2 text-muted small">Current: <span class="text-emerald">{{ $setting->logo }}</span></div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group-custom">
                        <label class="form-label-custom">Favicon File</label>
                        <input type="file" name="favicon" class="form-control-custom file-input">
                        @if(!empty($setting->favicon))
                            <div class="mt-2 text-muted small">Current: <span class="text-emerald">{{ $setting->favicon }}</span></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- القسم الثالث: إعدادات المتجر والتجارة الإلكترونية -->
        <div class="custom-card mb-4">
            <div class="card-title-wrapper mb-4">
                <i class="fas fa-shopping-bag section-icon"></i>
                <h3 class="mb-0">Store Configuration</h3>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-custom">Currency Symbol</label>
                        <input type="text" name="currency" class="form-control-custom" 
                               value="{{ old('currency', $setting->currency ?? '$') }}" placeholder="USD, EUR, LBP">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-custom">Shipping Cost</label>
                        <input type="number" step="0.01" name="shipping_cost" class="form-control-custom" 
                               value="{{ old('shipping_cost', $setting->shipping_cost ?? '0.00') }}" placeholder="0.00">
                    </div>
                </div>
            </div>
        </div>

        <!-- القسم الرابع: إعدادات قسم الـ Hero في الصفحة الرئيسية للمتجر -->
        <div class="custom-card mb-4">
            <div class="card-title-wrapper mb-4">
                <i class="fas fa-window-maximize section-icon"></i>
                <h3 class="mb-0">Hero Section Content</h3>
            </div>
            
            <div class="form-group-custom mb-4">
                <label class="form-label-custom">Hero Title</label>
                <input type="text" name="hero_title" class="form-control-custom" 
                       value="{{ old('hero_title', $setting->hero_title ?? '') }}" placeholder="Catchy title for landing page">
            </div>

            <div class="form-group-custom">
                <label class="form-label-custom">Hero Description</label>
                <textarea name="hero_description" class="form-control-custom" rows="3" 
                          placeholder="Short introductory description about your phone store...">{{ old('hero_description', $setting->hero_description ?? '') }}</textarea>
            </div>
        </div>

        <!-- القسم الخامس: روابط شبكات التواصل الاجتماعي -->
        <div class="custom-card mb-4">
            <div class="card-title-wrapper mb-4">
                <i class="fas fa-share-alt section-icon"></i>
                <h3 class="mb-0">Social Media Links</h3>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-custom"><i class="fab fa-facebook me-2 text-primary"></i> Facebook URL</label>
                        <input type="text" name="facebook" class="form-control-custom" 
                               value="{{ old('facebook', $setting->facebook ?? '') }}" placeholder="https://facebook.com/your-page">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-custom"><i class="fab fa-instagram me-2 text-danger"></i> Instagram URL</label>
                        <input type="text" name="instagram" class="form-control-custom" 
                               value="{{ old('instagram', $setting->instagram ?? '') }}" placeholder="https://instagram.com/your-profile">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-custom"><i class="fab fa-twitter me-2 text-info"></i> Twitter / X URL</label>
                        <input type="text" name="twitter" class="form-control-custom" 
                               value="{{ old('twitter', $setting->twitter ?? '') }}" placeholder="https://x.com/your-handle">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-custom"><i class="fab fa-linkedin me-2 text-primary"></i> LinkedIn URL</label>
                        <input type="text" name="linkedin" class="form-control-custom" 
                               value="{{ old('linkedin', $setting->linkedin ?? '') }}" placeholder="https://linkedin.com/in/your-profile">
                    </div>
                </div>
            </div>
        </div>

        <!-- شريط الحفظ العائم المتناسق والمحاذي -->
        <div class="d-flex justify-content-end align-items-center gap-3 pt-2">
            <button type="submit" class="btn-save-settings">
                <i class="fas fa-save me-2"></i> Save All Changes
            </button>
        </div>
    </form>
</div>
@endsection
<!-- التنسيقات المخصصة للـ Inputs الاستثنائية والبطاقات الفخمة المتناسقة مع قالبك الداكن -->
<style>
    .custom-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md, 8px);
        padding: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .card-title-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
        border-b: 1px solid var(--border-color);
        padding-bottom: 10px;
    }

    .card-title-wrapper h3 {
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--text-color);
        letter-spacing: 0.3px;
    }

    .section-icon {
        color: var(--primary-color, #00ff87);
        font-size: 1.2rem;
    }

    .form-group-custom {
        display: flex;
        flex-content: column;
        gap: 8px;
    }

    .form-label-custom {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--text-muted, #94a3b8);
        margin-bottom: 2px;
    }

    .form-control-custom {
        width: 100%;
        background-color: var(--bg-color, #0f0f0f) !important;
        border: 1px solid var(--border-color, #222) !important;
        color: var(--text-color, #ffffff) !important;
        padding: 10px 14px;
        border-radius: var(--radius-sm, 6px);
        font-size: 0.9rem;
        transition: var(--transition, all 0.2s ease);
    }

    .form-control-custom:focus {
        border-color: var(--primary-color, #00ff87) !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 255, 135, 0.1) !important;
    }

    .file-input {
        padding: 7px 12px;
    }

    .color-picker-custom {
        width: 45px;
        height: 45px;
        cursor: pointer;
        border: 1px solid var(--border-color);
        padding: 0;
        background: transparent;
        border-radius: 50%;
        overflow: hidden;
    }

    .color-picker-custom::-webkit-color-swatch-wrapper {
        padding: 0;
    }

    .color-picker-custom::-webkit-color-swatch {
        border: none;
    }

    .text-emerald {
        color: var(--primary-color, #00ff87);
    }

    .alert-success-custom {
        background-color: rgba(0, 255, 135, 0.06);
        border: 1px solid rgba(0, 255, 135, 0.2);
        color: #00ff87;
        padding: 12px 16px;
        border-radius: var(--radius-sm, 6px);
        font-size: 0.9rem;
    }

    .btn-save-settings {
        background-color: var(--primary-color, #00ff87);
        color: #000000 !important;
        border: none;
        padding: 12px 28px;
        border-radius: var(--radius-sm, 6px);
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: var(--transition, all 0.2s ease);
        box-shadow: 0 4px 14px rgba(0, 255, 135, 0.2);
    }

    .btn-save-settings:hover {
        background-color: #00e074;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(0, 255, 135, 0.35);
    }
</style>