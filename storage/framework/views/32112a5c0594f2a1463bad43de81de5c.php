<?php $__env->startSection('title', 'Iniciar Sesión'); ?>


<?php $__env->startSection('adminlte_css_pre'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">

    <style>
        /* Fondo moderno */
        body.login-page {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            background-size: cover;
        }

        /* Card Login */
        .login-box .card {
            border-radius: 15px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.3);
            border: none;
        }

        /* Header */
        .login-logo a {
            font-weight: bold;
            font-size: 28px;
            color: #2c5364;
        }

        /* Inputs */
        .form-control {
            border-radius: 8px;
            height: 45px;
        }

        .input-group-text {
            border-radius: 0 8px 8px 0;
            background: #2c5364;
            color: white;
        }

        /* Botón login */
        .btn-login {
            background: linear-gradient(45deg, #1d976c, #93f9b9);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Footer links */
        .login-footer a {
            color: #2c5364;
            font-weight: 500;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php
    $loginUrl = View::getSection('login_url') ?? config('adminlte.login_url', 'login');
    $registerUrl = View::getSection('register_url') ?? config('adminlte.register_url', 'register');
    $passResetUrl = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset');

    if (config('adminlte.use_route_url', false)) {
        $loginUrl = $loginUrl ? route($loginUrl) : '';
        $registerUrl = $registerUrl ? route($registerUrl) : '';
        $passResetUrl = $passResetUrl ? route($passResetUrl) : '';
    } else {
        $loginUrl = $loginUrl ? url($loginUrl) : '';
        $registerUrl = $registerUrl ? url($registerUrl) : '';
        $passResetUrl = $passResetUrl ? url($passResetUrl) : '';
    }
?>


<?php $__env->startSection('auth_header'); ?>
    <h4 class="text-center font-weight-bold">
        🔐 Bienvenido al Sistema
    </h4>
    <p class="text-center text-muted mb-4">
        Inicia sesión para continuar
    </p>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('auth_body'); ?>

    <form action="<?php echo e($loginUrl); ?>" method="post">
        <?php echo csrf_field(); ?>

        
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                placeholder="Correo electrónico" value="<?php echo e(old('email')); ?>" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>

            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                placeholder="Contraseña">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>

            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback"><strong><?php echo e($message); ?></strong></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="row mb-3">
            <div class="col-6">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                    <label for="remember">
                        Recordarme
                    </label>
                </div>
            </div>

            <div class="col-6">
                <button type="submit" class="btn btn-login btn-block">
                    <i class="fas fa-sign-in-alt"></i> Ingresar
                </button>
            </div>
        </div>

    </form>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('auth_footer'); ?>
    <div class="login-footer text-center">

        <?php if($passResetUrl): ?>
            <p class="mb-1">
                <a href="<?php echo e($passResetUrl); ?>">
                    ¿Olvidaste tu contraseña?
                </a>
            </p>
        <?php endif; ?>

        <?php if($registerUrl): ?>
            <p class="mb-0">
                <a href="<?php echo e($registerUrl); ?>">
                    Crear nueva cuenta
                </a>
            </p>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::auth.auth-page', ['authType' => 'login'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Seguimiento\vendor\jeroennoten\laravel-adminlte\src/../resources/views/auth/login.blade.php ENDPATH**/ ?>