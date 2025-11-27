<button class="mobile-action-btn mobile-notification-btn" type="button" data-bs-toggle="dropdown" aria-label="{{ __('app.notifications') }}">
    <i class="fas fa-bell google-icon" aria-hidden="true"></i>
    <span class="notification-badge">3</span>
</button>
<ul class="mobile-dropdown-menu dropdown-menu dropdown-menu-end">
    <li class="mobile-dropdown-header">
        <div class="mobile-notification-title">{{ __('app.notifications') }}</div>
    </li>
    <li><hr class="mobile-dropdown-divider"></li>
    <li>
        <a class="mobile-dropdown-item" href="#">
            <div class="mobile-notification-item">
                <div class="mobile-notification-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="mobile-notification-content">
                    <div class="mobile-notification-message">{{ __('app.nouveau_notification') }}</div>
                    <div class="mobile-notification-time">2 hours ago</div>
                </div>
            </div>
        </a>
    </li>
</ul>