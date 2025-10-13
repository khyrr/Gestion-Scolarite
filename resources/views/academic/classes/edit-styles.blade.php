{{-- This file contains the styles for edit.blade.php - copy to @push('styles') section --}}

<style>
    /* Material Design Variables */
    :root {
        --md-primary: #0d6efd;
        --md-primary-hover: #0b5ed7;
        --md-gray-50: #f8f9fa;
        --md-gray-100: #f1f3f5;
        --md-gray-200: #e9ecef;
        --md-gray-300: #dee2e6;
        --md-gray-400: #ced4da;
        --md-gray-500: #adb5bd;
        --md-gray-600: #6c757d;
        --md-gray-700: #495057;
        --md-gray-800: #343a40;
        --md-gray-900: #212529;
        --md-radius: 12px;
        --md-radius-sm: 8px;
        --md-shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
        --md-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        --md-shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
        --md-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Container */
    .container-fluid {
        max-width: 1400px;
    }

    /* Header Icon */
    .form-icon-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--md-primary), var(--md-primary-hover));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: var(--md-shadow);
    }

    /* Mini Statistics Cards */
    .stat-card-mini {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        background: white;
        border-radius: var(--md-radius-sm);
        border: 1px solid var(--md-gray-200);
        box-shadow: var(--md-shadow-sm);
        transition: var(--md-transition);
    }

    .stat-card-mini:hover {
        transform: translateY(-2px);
        box-shadow: var(--md-shadow);
        border-color: var(--md-gray-300);
    }

    .stat-icon-mini {
        width: 44px;
        height: 44px;
        border-radius: var(--md-radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        flex-shrink: 0;
    }

    .stat-icon-mini.bg-primary {
        background: linear-gradient(135deg, var(--md-primary), var(--md-primary-hover));
    }

    .stat-icon-mini.bg-success {
        background: linear-gradient(135deg, #28a745, #20c997);
    }

    .stat-icon-mini.bg-info {
        background: linear-gradient(135deg, #17a2b8, #0dcaf0);
    }

    .stat-value-mini {
        font-size: 20px;
        font-weight: 700;
        color: var(--md-gray-900);
        line-height: 1.2;
    }

    .stat-label-mini {
        font-size: 12px;
        color: var(--md-gray-600);
        line-height: 1.3;
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: var(--md-radius);
        box-shadow: var(--md-shadow-sm);
        border: 1px solid var(--md-gray-200);
        overflow: hidden;
        transition: var(--md-transition);
    }

    .form-card form {
        padding: 32px;
    }

    /* Form Section */
    .form-section {
        margin-bottom: 32px;
        padding-bottom: 32px;
        border-bottom: 1px solid var(--md-gray-200);
    }

    .form-section:last-of-type {
        margin-bottom: 24px;
        padding-bottom: 0;
        border-bottom: none;
    }

    .form-section-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--md-gray-700);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 20px;
    }

    /* Form Groups */
    .form-group-md {
        margin-bottom: 24px;
    }

    .form-group-md:last-child {
        margin-bottom: 0;
    }

    /* Form Labels */
    .form-label-md {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: var(--md-gray-700);
        margin-bottom: 8px;
    }

    /* Form Controls */
    .form-control-md {
        width: 100%;
        padding: 12px 16px;
        font-size: 15px;
        line-height: 1.5;
        color: var(--md-gray-900);
        background-color: var(--md-gray-50);
        border: 2px solid var(--md-gray-300);
        border-radius: var(--md-radius-sm);
        transition: var(--md-transition);
    }

    .form-control-md:focus {
        outline: none;
        background-color: white;
        border-color: var(--md-primary);
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }

    .form-control-md::placeholder {
        color: var(--md-gray-500);
    }

    .form-control-md.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    .form-control-md.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
    }

    /* Select Styling */
    select.form-control-md {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236c757d' d='M10.293 3.293L6 7.586 1.707 3.293A1 1 0 00.293 4.707l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 40px;
    }

    [dir="rtl"] select.form-control-md {
        background-position: left 16px center;
        padding-right: 16px;
        padding-left: 40px;
    }

    /* Help Text */
    .form-help-text {
        display: block;
        margin-top: 6px;
        font-size: 13px;
        color: var(--md-gray-600);
    }

    /* Invalid Feedback */
    .invalid-feedback {
        display: block;
        margin-top: 6px;
        font-size: 13px;
        color: #dc3545;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding-top: 24px;
        border-top: 1px solid var(--md-gray-200);
    }

    /* Material Buttons */
    .btn-md {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 24px;
        font-size: 15px;
        font-weight: 500;
        line-height: 1.5;
        border-radius: var(--md-radius-sm);
        border: none;
        cursor: pointer;
        transition: var(--md-transition);
        text-decoration: none;
        min-height: 44px;
    }

    .btn-md.btn-primary {
        background: linear-gradient(135deg, var(--md-primary), var(--md-primary-hover));
        color: white;
        box-shadow: var(--md-shadow-sm);
    }

    .btn-md.btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--md-shadow);
    }

    .btn-md.btn-primary:active {
        transform: translateY(0);
    }

    .btn-md.btn-secondary {
        background: white;
        color: var(--md-gray-700);
        border: 2px solid var(--md-gray-300);
    }

    .btn-md.btn-secondary:hover {
        background: var(--md-gray-50);
        border-color: var(--md-gray-400);
    }

    .btn-md.btn-info {
        background: linear-gradient(135deg, #17a2b8, #0dcaf0);
        color: white;
        box-shadow: var(--md-shadow-sm);
    }

    .btn-md.btn-info:hover {
        transform: translateY(-2px);
        box-shadow: var(--md-shadow);
    }

    /* RTL Support */
    [dir="rtl"] .form-icon-wrapper {
        margin-right: 0;
        margin-left: 1rem;
    }

    [dir="rtl"] .stat-card-mini {
        text-align: right;
    }

    /* Responsive Design */
    @media (max-width: 991.98px) {
        .stat-card-mini {
            padding: 14px;
        }

        .stat-icon-mini {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .stat-value-mini {
            font-size: 18px;
        }
    }

    @media (max-width: 767.98px) {
        .form-card form {
            padding: 24px 20px;
        }

        .form-section {
            margin-bottom: 24px;
            padding-bottom: 24px;
        }

        .form-actions {
            flex-direction: column;
            gap: 12px;
        }

        .form-actions > div {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-md {
            width: 100%;
        }

        .form-icon-wrapper {
            width: 48px;
            height: 48px;
            font-size: 20px;
        }

        .stat-card-mini {
            padding: 12px;
        }

        .stat-value-mini {
            font-size: 16px;
        }

        .stat-label-mini {
            font-size: 11px;
        }
    }

    @media (max-width: 575.98px) {
        .container-fluid {
            padding-left: 16px;
            padding-right: 16px;
        }

        .form-card form {
            padding: 20px 16px;
        }
    }
</style>
