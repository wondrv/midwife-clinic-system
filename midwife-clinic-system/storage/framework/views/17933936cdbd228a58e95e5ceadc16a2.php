<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title><?php echo e(config('app.name', 'Midwife Clinic')); ?> <?php echo $__env->yieldContent('title'); ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-dark: #3730a3;
            --secondary-color: #06b6d4;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --sidebar-width: 280px;
            --header-height: 70px;
            --border-radius: 12px;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --bg-color: #ffffff;
            --text-color: #1e293b;
            --card-bg: #ffffff;
            --content-bg: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--content-bg);
            line-height: 1.6;
            color: var(--text-color);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 1000;
            transform: translateX(-100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
        }

        .sidebar.show {
            transform: translateX(0);
        }

        /* Desktop - Always show sidebar */
        @media (min-width: 992px) {
            .sidebar {
                transform: translateX(0);
            }
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .sidebar-brand i {
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-section-title {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem 1.5rem 0.5rem;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1.5rem;
            margin: 0.2rem 0.75rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            text-decoration: none;
            position: relative;
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            opacity: 0.8;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(4px);
        }

        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 20px;
            background: white;
            border-radius: 0 2px 2px 0;
        }

        /* Main Content */
        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Desktop - Always account for sidebar */
        @media (min-width: 992px) {
            .main-content.sidebar-open {
                margin-left: var(--sidebar-width);
            }
        }

        /* Top Header */
        .top-header {
            height: var(--header-height);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .mobile-toggle {
            display: block;
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #64748b;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .mobile-toggle:hover {
            background: #f1f5f9;
            color: var(--primary-color);
        }

        /* Hide mobile toggle on desktop */
        @media (min-width: 992px) {
            .mobile-toggle {
                display: none;
            }
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-dropdown {
            position: relative;
        }

        .user-dropdown .dropdown-toggle {
            background: none;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
            color: #475569;
            font-weight: 500;
        }

        .user-dropdown .dropdown-toggle:hover {
            background: #f1f5f9;
            color: var(--primary-color);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 2rem;
            background: var(--content-bg);
            min-height: calc(100vh - var(--header-height));
        }

        /* Enhanced Card Styles */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .card-header {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Tables */
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead th {
            background: rgba(var(--bs-primary-rgb), 0.05);
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 1rem;
        }

        .table tbody td {
            border: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.03);
        }

        /* Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            position: relative;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 100%);
            pointer-events: none;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: var(--border-radius);
            border-left: 4px solid;
        }

        .alert-success {
            background: #f0fdf4;
            border-left-color: var(--success-color);
            color: #166534;
        }

        .alert-danger {
            background: #fef2f2;
            border-left-color: var(--danger-color);
            color: #991b1b;
        }

        .alert-warning {
            background: #fffbeb;
            border-left-color: var(--warning-color);
            color: #92400e;
        }

        /* Low Stock Highlighting */
        .low-stock {
            background: linear-gradient(90deg, #fef2f2 0%, #fee2e2 100%) !important;
            border-left: 4px solid var(--danger-color) !important;
        }

        .low-stock td {
            color: #991b1b !important;
            font-weight: 500;
        }

        /* Mobile Responsiveness Enhancements */
        @media (max-width: 1200px) {
            .container-fluid {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            
            .card-body {
                padding: 1.5rem !important;
            }
        }

        @media (max-width: 768px) {
            .h2 {
                font-size: 1.5rem !important;
            }
            
            .stats-card .card-body {
                padding: 1rem !important;
            }
            
            .table-responsive {
                font-size: 0.875rem;
            }
            
            .btn-group .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
            
            .badge {
                font-size: 0.675rem;
                padding: 0.35rem 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .container-fluid {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }
            
            .card {
                margin-bottom: 1rem !important;
            }
            
            .d-flex.justify-content-between {
                flex-direction: column !important;
                gap: 1rem;
            }
            
            .btn-group {
                flex-direction: column !important;
            }
            
            .table thead {
                display: none;
            }
            
            .table tbody tr {
                display: block;
                border: 1px solid #dee2e6;
                margin-bottom: 0.5rem;
                border-radius: 0.375rem;
            }
            
            .table tbody td {
                display: block;
                text-align: right;
                border: none;
                padding: 0.5rem 1rem;
            }
            
            .table tbody td:before {
                content: attr(data-label) ": ";
                float: left;
                font-weight: bold;
            }
        }

        /* Tooltip Enhancements */
        [data-bs-toggle="tooltip"] {
            cursor: help;
        }

        /* Loading States */
        .btn.loading {
            pointer-events: none;
            opacity: 0.6;
        }

        .btn.loading::after {
            content: "";
            display: inline-block;
            width: 14px;
            height: 14px;
            margin-left: 0.5rem;
            border: 2px solid currentColor;
            border-radius: 50%;
            border-right-color: transparent;
            animation: spin 0.75s linear infinite;
        }

        /* Hover Animations */
        .card-header:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.02) !important;
            transition: background-color 0.2s ease;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.03) !important;
            transform: scale(1.002);
            transition: all 0.2s ease;
        }

        /* Success/Error Messages */
        .alert {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: rgb(16, 185, 129);
            border-left: 4px solid rgb(16, 185, 129);
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: rgb(239, 68, 68);
            border-left: 4px solid rgb(239, 68, 68);
        }

        .alert-warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: rgb(245, 158, 11);
            border-left: 4px solid rgb(245, 158, 11);
        }

        .alert-info {
            background-color: rgba(59, 130, 246, 0.1);
            color: rgb(59, 130, 246);
            border-left: 4px solid rgb(59, 130, 246);
        }

        /* Notification System */
        .toast-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 9999;
        }

        .toast {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            max-width: 350px;
        }

        .toast.success {
            border-left: 4px solid var(--success-color);
        }

        .toast.error {
            border-left: 4px solid var(--danger-color);
        }

        .toast.warning {
            border-left: 4px solid var(--warning-color);
        }

        .toast.info {
            border-left: 4px solid var(--primary-color);
        }

        /* Improved Form Validation */
        .was-validated .form-control:valid {
            border-color: var(--success-color);
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='m2.3 6.73.94-.94 2.94 2.94L7.83 6.01 8.77 6.95 6.17 9.56z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .was-validated .form-control:invalid {
            border-color: var(--danger-color);
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 4.6 1.4 1.4m0-1.4-1.4 1.4'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        /* Enhanced Search Input */
        .search-container {
            position: relative;
        }

        .search-container .form-control {
            padding-left: 2.5rem;
        }

        .search-container .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 5;
        }

        /* Dark Mode Support - Disabled to force light theme */
        /*
        @media (prefers-color-scheme: dark) {
            :root {
                --bg-color: #1e293b;
                --text-color: #f1f5f9;
                --card-bg: #334155;
            }
            
            body {
                background: linear-gradient(135deg, var(--bg-color) 0%, #334155 100%);
                color: var(--text-color);
            }
            
            .card {
                background: var(--card-bg);
                color: var(--text-color);
            }
            
            .table {
                color: var(--text-color);
            }
            
            .form-control {
                background: var(--card-bg);
                border-color: #475569;
                color: var(--text-color);
            }
            
            .form-control:focus {
                background: var(--card-bg);
                border-color: var(--primary-color);
                color: var(--text-color);
            }
        }
        */
        
        /* Floating Language Switcher */
        .floating-language-switcher {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
            background: var(--primary-color);
            border-radius: 50px;
            padding: 12px 16px;
            box-shadow: var(--shadow-lg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .floating-language-switcher:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .floating-language-switcher .language-toggle {
            background: none;
            border: none;
            color: white;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            padding: 0;
        }
        
        .floating-language-switcher .language-dropdown {
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            margin-bottom: 8px;
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(0, 0, 0, 0.1);
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .floating-language-switcher:hover .language-dropdown,
        .floating-language-switcher.active .language-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .floating-language-switcher .language-option {
            display: block;
            width: 100%;
            padding: 12px 16px;
            color: var(--text-color);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border: none;
            background: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
            text-align: left;
        }
        
        .floating-language-switcher .language-option:hover {
            background: var(--content-bg);
        }
        
        .floating-language-switcher .language-option.active {
            background: var(--primary-color);
            color: white;
        }
        
        .floating-language-switcher .flag {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <?php if(auth()->guard()->check()): ?>
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="<?php echo e(route('dashboard')); ?>" class="sidebar-brand">
                    <i class="fas fa-heartbeat"></i>
                    <span><?php echo e(config('app.name')); ?></span>
                </a>
            </div>
            
            <div class="sidebar-nav">
                <div class="nav-section-title"><?php echo e(__('app.dashboard')); ?></div>
                <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span><?php echo e(__('app.dashboard')); ?></span>
                </a>
                <a class="nav-link <?php echo e(request()->routeIs('patients.*') ? 'active' : ''); ?>" href="<?php echo e(route('patients.index')); ?>">
                    <i class="fas fa-users"></i>
                    <span><?php echo e(__('app.patients')); ?></span>
                </a>
                <a class="nav-link <?php echo e(request()->routeIs('transactions.*') ? 'active' : ''); ?>" href="<?php echo e(route('transactions.index')); ?>">
                    <i class="fas fa-receipt"></i>
                    <span><?php echo e(__('app.transactions')); ?></span>
                </a>
                
                <?php if(auth()->user()->isAdmin()): ?>
                    <div class="nav-section-title"><?php echo e(__('app.admin')); ?></div>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.services.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.services.index')); ?>">
                        <i class="fas fa-cogs"></i>
                        <span><?php echo e(__('app.services')); ?></span>
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.medicines.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.medicines.index')); ?>">
                        <i class="fas fa-pills"></i>
                        <span><?php echo e(__('app.medicines')); ?></span>
                    </a>
                    <a class="nav-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.users.index')); ?>">
                        <i class="fas fa-user-md"></i>
                        <span><?php echo e(__('app.users')); ?></span>
                    </a>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo e(request()->routeIs('admin.reports.*') ? 'active' : ''); ?>" 
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-chart-bar"></i>
                            <span><?php echo e(__('app.reports')); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo e(route('admin.reports.transactions')); ?>">
                                <i class="fas fa-receipt me-2"></i><?php echo e(__('app.transaction_reports')); ?>

                            </a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('admin.reports.patients')); ?>">
                                <i class="fas fa-users me-2"></i><?php echo e(__('app.patient_reports')); ?>

                            </a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </nav>

        <!-- Main Content Wrapper -->
        <div class="main-content <?php echo e(auth()->check() ? 'sidebar-open' : ''); ?>">
            <!-- Top Header -->
            <header class="top-header">
                <button class="mobile-toggle" type="button" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="header-actions">
                    <div class="user-dropdown">
                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                            </div>
                            <div class="d-none d-md-block">
                                <div style="font-size: 0.875rem;"><?php echo e(auth()->user()->name); ?></div>
                                <div style="font-size: 0.75rem; color: #64748b;"><?php echo e(ucfirst(auth()->user()->role)); ?></div>
                            </div>
                            <i class="fas fa-chevron-down ms-1" style="font-size: 0.75rem;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">
                                    <i class="fas fa-user me-2"></i><?php echo e(__('app.profile')); ?>

                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="<?php echo e(route('logout')); ?>"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i><?php echo e(__('app.logout')); ?>

                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="content-area">
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>

        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
        </form>
    <?php else: ?>
        <!-- Public Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                    <i class="fas fa-heartbeat me-2 text-primary"></i>
                    <span class="fw-bold"><?php echo e(config('app.name')); ?></span>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('home')); ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('public.services')); ?>">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('public.contact')); ?>">Contact</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn btn-primary" href="<?php echo e(route('login')); ?>">
                                <i class="fas fa-sign-in-alt me-1"></i> Staff Login
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Main Content for Public -->
        <main class="main-content">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </main>
    <?php endif; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        });

        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            
            if (window.innerWidth < 992 && sidebar && !sidebar.contains(event.target) && !toggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });
    </script>
    
    <!-- Floating Language Switcher -->
    <div class="floating-language-switcher" id="languageSwitcher">
        <button class="language-toggle" type="button">
            <span class="flag">
                <?php if(app()->getLocale() == 'id'): ?>
                    🇮🇩
                <?php else: ?>
                    🇺🇸
                <?php endif; ?>
            </span>
            <span>
                <?php if(app()->getLocale() == 'id'): ?>
                    ID
                <?php else: ?>
                    EN
                <?php endif; ?>
            </span>
            <i class="fas fa-chevron-up" style="font-size: 10px;"></i>
        </button>
        
        <div class="language-dropdown">
            <form action="<?php echo e(route('language.switch')); ?>" method="POST" style="margin: 0;">
                <?php echo csrf_field(); ?>
                <button type="submit" name="locale" value="en" class="language-option <?php echo e(app()->getLocale() == 'en' ? 'active' : ''); ?>">
                    <span class="flag">🇺🇸</span>
                    English
                </button>
                <button type="submit" name="locale" value="id" class="language-option <?php echo e(app()->getLocale() == 'id' ? 'active' : ''); ?>">
                    <span class="flag">🇮🇩</span>
                    Bahasa Indonesia
                </button>
            </form>
        </div>
    </div>
    
    <script>
        // Language switcher interactions
        document.addEventListener('DOMContentLoaded', function() {
            const languageSwitcher = document.getElementById('languageSwitcher');
            
            if (languageSwitcher) {
                languageSwitcher.addEventListener('click', function(e) {
                    e.stopPropagation();
                    this.classList.toggle('active');
                });
                
                document.addEventListener('click', function() {
                    languageSwitcher.classList.remove('active');
                });
            }
        });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\chiar\Downloads\bidan\midwife-clinic-system\resources\views/layouts/app.blade.php ENDPATH**/ ?>