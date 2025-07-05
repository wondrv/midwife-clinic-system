

<?php $__env->startSection('title', __('app.services')); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<section class="bg-primary text-white py-4">
    <div class="container">
        <h1 class="h2 mb-0"><?php echo e(__('app.our_services')); ?></h1>
        <p class="lead mb-0"><?php echo e(__('app.professional_maternal_healthcare')); ?></p>
    </div>
</section>

<!-- Services List -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card service-card h-100 border-0 shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-stethoscope text-primary fs-1 mb-3"></i>
                        <h5 class="card-title"><?php echo e($service->name); ?></h5>
                        <?php if($service->description): ?>
                            <p class="text-muted"><?php echo e($service->description); ?></p>
                        <?php endif; ?>
                        <h4 class="text-primary">Rp <?php echo e(number_format($service->price, 0, ',', '.')); ?></h4>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-center">
                        <small class="text-muted"><?php echo e(__('app.professional_service_by_midwives')); ?></small>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <h5><?php echo e(__('app.services_coming_soon')); ?></h5>
                    <p class="mb-0"><?php echo e(__('app.updating_service_offerings')); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-light py-5">
    <div class="container text-center">
        <h3 class="mb-4"><?php echo e(__('app.need_consultation')); ?></h3>
        <p class="lead mb-4"><?php echo e(__('app.contact_for_appointment')); ?></p>
        <a href="<?php echo e(route('public.contact')); ?>" class="btn btn-primary btn-lg"><?php echo e(__('app.contact_us')); ?></a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\chiar\Downloads\bidan\midwife-clinic-system\resources\views/public/services.blade.php ENDPATH**/ ?>