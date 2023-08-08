@forelse ($schoolNurse->subject->sortByDesc('created_at') as $log)
    <div class="history-content-item">
        <div class="history-content-item-top">
            <p class="history-content-item-top-title">Log</p>
            <p class="history-content-item-top-title">Date</p>
        </div>
        <div class="history-content-item-bottom">
            <p
                class="history-content-item-bottom-title"
                style="color: #9f9f9f"
            >
                {{ $log->description }}
            </p>
            <p class="history-content-item-bottom-title">{{ $log->created_at->format('F d, Y') }}</p>
        </div>
    </div>
@empty

@endforelse
