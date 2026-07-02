@extends('dash.master_dash')
@section('content')

            <div class="content-wrapper">
                <div class="page-header">
                    <h1 class="page-title">General Settings</h1>
                </div>

                <div class="card" style="margin-bottom: 2rem;">
                    <h3>Appearance</h3>
                    <div style="margin-top: 1.5rem;">
                        <div class="form-group">
                            <label class="form-label">Theme Mode</label>
                            <div style="display: flex; gap: 1rem;">
                                <button class="btn" style="border: 1px solid var(--border-color);"
                                    onclick="document.documentElement.setAttribute('data-theme', 'light'); localStorage.setItem('theme', 'light');">
                                    <i class="fas fa-sun" style="color: #f59e0b;"></i> Light Mode
                                </button>
                                <button class="btn"
                                    style="border: 1px solid var(--border-color); background-color: #1e293b; color: white;"
                                    onclick="document.documentElement.setAttribute('data-theme', 'dark'); localStorage.setItem('theme', 'dark');">
                                    <i class="fas fa-moon"></i> Dark Mode
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Primary Color</label>
                            <input type="color" value="#2563eb"
                                onchange="document.documentElement.style.setProperty('--primary-color', this.value)"
                                style="width: 50px; height: 50px; cursor: pointer; border: none; padding: 0;">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h3>Site Information</h3>
                    <div style="margin-top: 1.5rem;">
                        <div class="form-group">
                            <label class="form-label">Site Title</label>
                            <input type="text" class="form-control" value="My Awesome Dashboard">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Admin Email</label>
                            <input type="email" class="form-control" value="admin@example.com">
                        </div>
                        <button class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection