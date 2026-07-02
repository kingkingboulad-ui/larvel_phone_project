@extends('dash.master_dash')
@section('content')

            <div class="content-wrapper">
                <div class="page-header">
                    <h1 class="page-title">Add New Video</h1>
                </div>

                <div class="card">
                    <form>
                        <div class="form-group">
                            <label class="form-label">Video Title</label>
                            <input type="text" class="form-control" placeholder="Enter video title" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Video URL / Source</label>
                            <input type="url" class="form-control" placeholder="https://youtube.com/..." required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" accept="image/*">
                            <div class="image-preview" style="height: 150px;">
                                <span class="preview-placeholder">Thumbnail Preview</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="4" placeholder="Video description..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload Video
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

@endsection