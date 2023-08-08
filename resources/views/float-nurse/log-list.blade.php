@forelse($nurse->subject->sortByDesc('created_at') as $log)
    <div class="tab-pane-content">
        <div class="tab-pane-content-card">
            <div class="tab-pane-content-card-info">
                <h3 class="tab-pane-content-card-info-title">Log</h3>
                <p class="tab-pane-content-card-info-desc" style="color:#9f9f9f;">
                    {{ $log->description }}
                </p>
            </div>
            <div class="tab-pane-content-card-info">
                <h3 class="tab-pane-content-card-info-title">Date</h3>
                <p class="tab-pane-content-card-info-desc">{{ $log->created_at->format('F d, Y') }}</p>
            </div>
        </div>
    </div>
@empty

@endforelse
