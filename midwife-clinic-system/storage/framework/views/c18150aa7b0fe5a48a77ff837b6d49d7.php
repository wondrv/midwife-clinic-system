<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> - 
        <?php if(app()->getLocale() == 'id'): ?>
            Klinik Bidan
        <?php else: ?>
            Midwife Clinic
        <?php endif; ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .service-card { transition: transform 0.3s; }
        .service-card:hover { transform: translateY(-5px); }
        
        /* Language Switcher Styles */
        .floating-language-switcher {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 8px;
            transition: all 0.3s ease;
        }

        .floating-language-switcher:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
        }

        .floating-language-switcher .language-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border: none;
            background: none;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s ease;
            color: #374151;
            font-weight: 500;
            font-size: 14px;
        }

        .floating-language-switcher .language-dropdown {
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.2s ease;
        }

        .floating-language-switcher:hover .language-dropdown,
        .floating-language-switcher.active .language-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .floating-language-switcher .language-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #374151;
            font-size: 14px;
            text-decoration: none;
        }

        .floating-language-switcher .language-option:hover {
            background: #f3f4f6;
            color: #1f2937;
        }

        .floating-language-switcher .language-option.active {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .floating-language-switcher .flag {
            width: 20px;
            height: 15px;
            border-radius: 2px;
            display: inline-block;
        }

        .flag-en {
            background: linear-gradient(to bottom, #012169 33%, #fff 33%, #fff 66%, #c8102e 66%);
        }

        .flag-id {
            background: linear-gradient(to bottom, #ff0000 50%, #fff 50%);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="<?php echo e(route('home')); ?>">
                <i class="fas fa-heartbeat me-2"></i>
                <?php if(app()->getLocale() == 'id'): ?>
                    Klinik Bidan
                <?php else: ?>
                    Midwife Clinic
                <?php endif; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('home')); ?>">
                            <?php if(app()->getLocale() == 'id'): ?>
                                Beranda
                            <?php else: ?>
                                Home
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('public.services')); ?>">
                            <?php if(app()->getLocale() == 'id'): ?>
                                Layanan
                            <?php else: ?>
                                Services
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('public.contact')); ?>">
                            <?php if(app()->getLocale() == 'id'): ?>
                                Kontak
                            <?php else: ?>
                                Contact
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-2" href="<?php echo e(route('login')); ?>">
                            <?php if(app()->getLocale() == 'id'): ?>
                                Login Staff
                            <?php else: ?>
                                Staff Login
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>&copy; <?php echo e(date('Y')); ?> 
                <?php if(app()->getLocale() == 'id'): ?>
                    Klinik Bidan. Hak cipta dilindungi.
                <?php else: ?>
                    Midwife Clinic. All rights reserved.
                <?php endif; ?>
            </p>
        </div>
    </footer>

    <!-- Floating Language Switcher -->
    <div class="floating-language-switcher" id="languageSwitcher">
        <button type="button" class="language-toggle">
            <span class="flag">
                <?php if(app()->getLocale() == 'id'): ?>
                    🇮🇩
                <?php else: ?>
                    🇺🇸
                <?php endif; ?>
            </span>
            <span><?php echo e(app()->getLocale() === 'en' ? 'EN' : 'ID'); ?></span>
            <i class="fas fa-chevron-up text-muted"></i>
        </button>
        <div class="language-dropdown">
            <form action="<?php echo e(route('language.switch')); ?>" method="POST" style="margin: 0;">
                <?php echo csrf_field(); ?>
                <button type="submit" name="locale" value="en" class="language-option <?php echo e(app()->getLocale() === 'en' ? 'active' : ''); ?>">
                    <span class="flag">🇺🇸</span>
                    <span>English</span>
                </button>
                <button type="submit" name="locale" value="id" class="language-option <?php echo e(app()->getLocale() === 'id' ? 'active' : ''); ?>">
                    <span class="flag">🇮🇩</span>
                    <span>Bahasa Indonesia</span>
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Language switcher functionality
        document.addEventListener('DOMContentLoaded', function() {
            const switcher = document.getElementById('languageSwitcher');
            
            switcher.addEventListener('click', function(e) {
                e.stopPropagation();
                this.classList.toggle('active');
            });
            
            document.addEventListener('click', function() {
                switcher.classList.remove('active');
            });
        });
    </script>
</body>
</html><?php /**PATH C:\Users\chiar\Downloads\bidan\midwife-clinic-system\resources\views/public/layout.blade.php ENDPATH**/ ?>