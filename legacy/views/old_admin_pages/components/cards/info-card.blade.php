@php
    $cardElement = $href ? 'a' : 'div';
    $cardAttributes = $href ? ['href' => $href, 'class' => 'text-decoration-none'] : [];
@endphp

<{{ $cardElement }} @if($href) href="{{ $href }}" class="text-decoration-none" @endif>
    <div class="card h-100 border-0 shadow-sm {{ $href ? 'card-hover' : '' }}">
        <div class="card-body">
            <div class="row align-items-center">
                <!-- Icon -->
                <div class="col-auto">
                    <div class="icon-circle bg-{{ $color }} bg-opacity-10">
                        <i class="{{ $icon }} text-{{ $color }}"></i>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="col">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="h2 mb-0 text-{{ $color }}">{{ $value }}</h3>
                            <p class="text-muted mb-0 small">{{ $title }}</p>
                        </div>
                        
                        <!-- Trend (if provided) -->
                        @if($trend)
                            <div class="col-auto">
                                <div class="d-flex align-items-center text-{{ $getTrendColor() }}">
                                    <i class="{{ $getTrendIcon() }} me-1" style="font-size: 0.8rem;"></i>
                                    <span class="small fw-bold">{{ $trend }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Arrow for clickable cards -->
                @if($href)
                    <div class="col-auto">
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
</{{ $cardElement }}>

<style>
.icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-circle i {
    font-size: 1.5rem;
}

.card-hover {
    transition: all 0.2s ease;
}

.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

a.text-decoration-none:hover {
    color: inherit !important;
}
</style>