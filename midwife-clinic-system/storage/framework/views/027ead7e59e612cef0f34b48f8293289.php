

<?php $__env->startSection('title', app()->getLocale() == 'id' ? 'Selamat Datang' : 'Welcome'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="hero-section text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    <?php if(app()->getLocale() == 'id'): ?>
                        Perawatan Bidan Profesional
                    <?php else: ?>
                        Professional Midwife Care
                    <?php endif; ?>
                </h1>
                <p class="lead mb-4">
                    <?php if(app()->getLocale() == 'id'): ?>
                        Memberikan perawatan maternal yang penuh kasih dan ahli dengan fasilitas modern dan bidan berpengalaman.
                    <?php else: ?>
                        Providing compassionate and expert maternal care with modern facilities and experienced midwives.
                    <?php endif; ?>
                </p>
                <a href="<?php echo e(route('public.services')); ?>" class="btn btn-light btn-lg">
                    <?php if(app()->getLocale() == 'id'): ?>
                        Lihat Layanan Kami
                    <?php else: ?>
                        View Our Services
                    <?php endif; ?>
                </a>
            </div>
            <div class="col-lg-6">
                <img src="https://via.placeholder.com/500x400/667eea/ffffff?text=Midwife+Care" class="img-fluid rounded" alt="Midwife Care">
            </div>
        </div>
    </div>
</section>

<!-- Services Preview -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">
            <?php if(app()->getLocale() == 'id'): ?>
                Layanan Kami
            <?php else: ?>
                Our Services
            <?php endif; ?>
        </h2>
        <div class="row">
            <?php $__currentLoopData = $services->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                <div class="card service-card h-100 border-0 shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-stethoscope text-primary fs-1 mb-3"></i>
                        <h5 class="card-title"><?php echo e($service->name); ?></h5>
                        <p class="text-muted">
                            <?php if(app()->getLocale() == 'id'): ?>
                                Layanan profesional yang disediakan oleh bidan berpengalaman kami
                            <?php else: ?>
                                Professional services provided by our experienced midwives
                            <?php endif; ?>
                        </p>
                        <h4 class="text-primary">Rp <?php echo e(number_format($service->price, 0, ',', '.')); ?></h4>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo e(route('public.services')); ?>" class="btn btn-primary">
                <?php if(app()->getLocale() == 'id'): ?>
                    Lihat Semua Layanan
                <?php else: ?>
                    View All Services
                <?php endif; ?>
            </a>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-map-marker-alt text-primary fs-1 mb-3"></i>
                <h5>
                    <?php if(app()->getLocale() == 'id'): ?>
                        Alamat
                    <?php else: ?>
                        Address
                    <?php endif; ?>
                </h5>
                <p>Jl. Kesehatan No. 123, Surabaya, Jawa Timur</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-phone text-primary fs-1 mb-3"></i>
                <h5>
                    <?php if(app()->getLocale() == 'id'): ?>
                        Telepon
                    <?php else: ?>
                        Phone
                    <?php endif; ?>
                </h5>
                <p>+62 31 1234 5678</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-clock text-primary fs-1 mb-3"></i>
                <h5>
                    <?php if(app()->getLocale() == 'id'): ?>
                        Jam Kerja
                    <?php else: ?>
                        Hours
                    <?php endif; ?>
                </h5>
                <p>
                    <?php if(app()->getLocale() == 'id'): ?>
                        Sen - Jum: 08:00 - 17:00
                    <?php else: ?>
                        Mon - Fri: 8:00 AM - 5:00 PM
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('public.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\chiar\Downloads\bidan\midwife-clinic-system\resources\views/public/home.blade.php ENDPATH**/ ?>