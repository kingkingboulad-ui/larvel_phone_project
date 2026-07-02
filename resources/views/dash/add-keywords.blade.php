@extends('dash.master_dash')
@section('content')

            <div class="content-wrapper">
                <div class="page-header">
                    <h1 class="page-title">SEO & Keywords</h1>
                </div>

                <div class="card">
                    <form>
                        <div class="form-group">
                            <label class="form-label">SEO Title</label>
                            <input type="text" class="form-control" placeholder="Page Title for Search Engines">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Target Keywords (Press Enter to add)</label>
                            <div class="tag-container">
                                <!-- Tags will be added here by JS -->
                                <input type="text" id="keyword-input" class="tag-input"
                                    placeholder="Type keyword and press specific Enter...">
                            </div>
                            <small style="color: var(--text-muted);">Separate keywords with Enter key</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Meta Description</label>
                            <textarea class="form-control" rows="3"
                                placeholder="Brief description for search results..."></textarea>
                            <div
                                style="margin-top: 1rem; padding: 1rem; border: 1px solid var(--border-color); background: #fff; border-radius: var(--radius-md);">
                                <h4
                                    style="color: #1a0dab; font-family: arial, sans-serif; font-size: 18px; margin-bottom: 2px;">
                                    Your Page Title Here</h4>
                                <div style="color: #006621; font-family: arial, sans-serif; font-size: 14px;">
                                    www.yoursite.com/page-url</div>
                                <div
                                    style="color: #545454; font-family: arial, sans-serif; font-size: 13px; line-height: 1.4;">
                                    This is how your page will appear in search engine results. The meta description
                                    should be concise and contain your target keywords.
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-chart-line"></i> Save SEO Settings
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>



    @endsection