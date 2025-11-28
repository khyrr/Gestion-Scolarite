/**
 * Dashboard Core JavaScript
 * Handles sidebar, language switching, alerts, and performance optimizations
 */

(function() {
    'use strict';

    // Enhanced Sidebar Management
    function initSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const sidebarOverlay = document.querySelector('.sidebar-overlay');
        const toggleBtns = document.querySelectorAll('.sidebar-toggle, .mobile-menu-btn');
        const closeBtn = document.querySelector('.sidebar-close');

        if (!sidebar) return;

        // Toggle sidebar function
        function toggleSidebar() {
            const isShowing = sidebar.classList.contains('show');

            if (isShowing) {
                closeSidebar();
            } else {
                openSidebar();
            }
        }

        function openSidebar() {
            sidebar.classList.add('show');
            sidebarOverlay?.classList.add('show');
            if (window.innerWidth <= 991) {
                document.body.style.overflow = 'hidden';
            }
        }

        function closeSidebar() {
            sidebar.classList.remove('show');
            sidebarOverlay?.classList.remove('show');
            document.body.style.overflow = '';
        }

        // Attach toggle functionality to all toggle buttons
        toggleBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleSidebar();
            });
        });

        // Close button functionality
        closeBtn?.addEventListener('click', (e) => {
            e.stopPropagation();
            closeSidebar();
        });

        // Close sidebar when clicking overlay
        sidebarOverlay?.addEventListener('click', closeSidebar);

        // Close sidebar on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && sidebar.classList.contains('show')) {
                closeSidebar();
            }
        });

        // Handle window resize with debounce
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (window.innerWidth > 991) {
                    closeSidebar();
                }
            }, 250);
        });

        // Smooth scroll to top on page navigation (for mobile)
        const navLinks = sidebar.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 991) {
                    setTimeout(() => {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }, 100);
                }
            });
        });
    }

    // Language Switcher Enhancement
    function initLanguageSwitcher() {
        const langSwitchers = document.querySelectorAll('.lang-switcher .dropdown-item');

        langSwitchers.forEach(item => {
            item.addEventListener('click', function(e) {
                // Add loading state
                const originalContent = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Chargement...';

                // Restore content after timeout (in case navigation fails)
                setTimeout(() => {
                    this.innerHTML = originalContent;
                }, 2000);
            });
        });
    }

    // Auto-hide alerts after 5 seconds
    function initAlerts() {
        const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
        
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert.parentNode && typeof bootstrap !== 'undefined') {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        });
    }

    // Enhanced accessibility
    function initAccessibility() {
        const sidebar = document.querySelector('.sidebar');
        if (!sidebar) return;

        const firstFocusableElement = sidebar.querySelector('a, button, input, textarea, select');

        // Focus management for sidebar
        sidebar.addEventListener('transitionend', () => {
            if (sidebar.classList.contains('show') && firstFocusableElement) {
                firstFocusableElement.focus();
            }
        });

        // Trap focus in sidebar when open on mobile
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Tab' && sidebar.classList.contains('show') && window.innerWidth <= 991) {
                const focusableElements = sidebar.querySelectorAll(
                    'a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])'
                );
                const firstElement = focusableElements[0];
                const lastElement = focusableElements[focusableElements.length - 1];

                if (e.shiftKey) {
                    if (document.activeElement === firstElement) {
                        e.preventDefault();
                        lastElement.focus();
                    }
                } else {
                    if (document.activeElement === lastElement) {
                        e.preventDefault();
                        firstElement.focus();
                    }
                }
            }
        });
    }

    // Page Transition Loader (NProgress)
    function initPageLoader() {
        if (typeof NProgress === 'undefined') return;

        NProgress.configure({ showSpinner: false });

        // Show loader on page unload (navigation start)
        window.addEventListener('beforeunload', () => {
            NProgress.start();
        });

        // Also trigger on link clicks for immediate feedback
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link && 
                !link.target && 
                !link.hasAttribute('download') && 
                link.href && 
                link.href.startsWith(window.location.origin) &&
                !link.href.includes('#') &&
                !e.ctrlKey && !e.metaKey && !e.shiftKey && !e.altKey
            ) {
                NProgress.start();
            }
        });

        // Complete loader when page finishes loading
        window.addEventListener('load', () => {
            NProgress.done();
        });
    }

    // Global Button Loading State
    function initButtonLoading() {
        document.addEventListener('submit', function(e) {
            const form = e.target;
            const submitBtn = form.querySelector('[type="submit"], button:not([type="button"]):not([type="reset"])');

            if (submitBtn && !submitBtn.classList.contains('no-loading')) {
                // Prevent double submission
                if (submitBtn.disabled) {
                    e.preventDefault();
                    return;
                }

                // Store original content
                submitBtn.dataset.originalContent = submitBtn.innerHTML;
                
                // Set loading state
                const loadingText = submitBtn.dataset.loadingText || 'Chargement...';
                submitBtn.disabled = true;
                submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>${loadingText}`;
            }
        });

        // Restore button state if page is restored from bfcache (back/forward navigation)
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                const submitBtns = document.querySelectorAll('[type="submit"][disabled], button[disabled]');
                submitBtns.forEach(btn => {
                    if (btn.dataset.originalContent) {
                        btn.innerHTML = btn.dataset.originalContent;
                        btn.disabled = false;
                    }
                });
                NProgress.done();
            }
        });
    }

    // Performance optimization: Debounced scroll handler
    function initScrollHandler() {
        let ticking = false;

        function updateScrollState() {
            const scrollTop = window.pageYOffset;
            const header = document.querySelector('.content-header');

            if (header) {
                if (scrollTop > 10) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
            ticking = false;
        }

        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(updateScrollState);
                ticking = true;
            }
        }, { passive: true });
    }

    // Initialize all components when DOM is ready
    function init() {
        initSidebar();
        initLanguageSwitcher();
        initAlerts();
        initAccessibility();
        initScrollHandler();
        initPageLoader();
        initButtonLoading();
    }

    // Run initialization
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
