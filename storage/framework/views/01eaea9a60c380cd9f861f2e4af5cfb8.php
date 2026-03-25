<?php $__env->startSection('title', 'Login - GandengTangan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container page">
    <div class="auth-wrap single">
        <div class="auth-card">
            <div class="auth-head">
                <div class="auth-brand">
                    <span class="auth-mark">◆</span>
                    <span>GandengTangan</span>
                </div>

                <h1 class="auth-title">Sign In</h1>
                <p class="auth-subtitle">
                    Masuk untuk mengelola karya, artis, dan produk di dashboard admin.
                </p>
            </div>

            <?php if(session('status')): ?>
                <div class="alert alert-success"><?php echo e(session('status')); ?></div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <div class="alert-title">Terjadi kesalahan:</div>
                    <ul class="alert-list">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login')); ?>" class="auth-form">
                <?php echo csrf_field(); ?>

                <div class="field">
                    <label class="label" for="email">Email</label>
                    <input class="input" id="email" type="email" name="email"
                           value="<?php echo e(old('email')); ?>" required autofocus autocomplete="username">
                </div>

                <div class="field">
                    <label class="label" for="password">Password</label>
                    <input class="input" id="password" type="password" name="password"
                           required autocomplete="current-password">
                </div>

                <div class="row">
                    <label class="check">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>

                    <?php if(Route::has('password.request')): ?>
                        <a class="link" href="<?php echo e(route('password.request')); ?>">Lupa password?</a>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary auth-btn">Login</button>
            </form>

            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\hyperUI\resources\views/auth/login.blade.php ENDPATH**/ ?>