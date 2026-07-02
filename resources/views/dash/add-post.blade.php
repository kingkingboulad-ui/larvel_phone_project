@extends('dash.master_dash')
@section('content')

            <div class="content-wrapper">
                <div class="page-header">
                    <h1 class="page-title">Add New Post</h1>
                </div>

                <div class="card">
                    <form>
                        <div class="form-group">
                            <label class="form-label">Post Title</label>
                            <input type="text" class="form-control" placeholder="Enter post title" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Content</label>
                            <textarea class="form-control" rows="8" placeholder="Write your post content here..."
                                required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Featured Image</label>
                            <input type="file" class="form-control" accept="image/*">
                            <div class="image-preview">
                                <span class="preview-placeholder">Image Preview</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control">
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Publish Post
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

@endsection