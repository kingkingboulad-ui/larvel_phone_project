@extends('dash.master_dash')
@section('content')

            <div class="content-wrapper">
                <div class="page-header">
                    <h1 class="page-title">User Profile</h1>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                    <!-- User Info Card -->
                    <div class="card" style="text-align: center;">
                        <div
                            style="width: 100px; height: 100px; background-color: var(--primary-color); border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 1.5rem;">
                            A
                        </div>
                        <h2
                            style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-color);">
                            Admin User</h2>
                        <p style="color: var(--text-muted); margin-bottom: 1.5rem;">Super Administrator</p>

                        <div style="display: flex; justify-content: center; gap: 1rem;">
                            <button class="btn btn-primary"><i class="fas fa-upload"></i> Change Avatar</button>
                        </div>
                    </div>

                    <!-- Edit Profile Form -->
                    <div class="card">
                        <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem;">Edit Profile Information</h3>
                        <form>
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" value="Admin User" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" value="admin@example.com" required>
                            </div>

                            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

                            <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem;">Change Password</h3>

                            <div class="form-group">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control" placeholder="••••••••">
                            </div>

                            <div class="form-group">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" placeholder="••••••••">
                            </div>

                            <button type="submit" class="btn btn-primary" style="width: 100%;">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

@endsection