@extends('dash.master_dash')
@section('content')

            <div class="content-wrapper">
                <div class="page-header">
                    <h1 class="page-title">Add New User</h1>
                </div>

                <div class="card" style="max-width: 700px;">
                    <form>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" placeholder="John Doe" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" placeholder="john@example.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Role</label>
                            <select class="form-control" required>
                                <option value="user">Standard User</option>
                                <option value="editor">Editor</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="••••••••" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Create User
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection