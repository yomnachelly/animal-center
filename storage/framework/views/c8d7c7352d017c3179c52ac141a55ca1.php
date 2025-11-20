<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Animal Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

<nav class="navbar navbar-dark bg-dark p-3">
    <a href="<?php echo e(route('home')); ?>" class="navbar-brand">Animal Center</a>

    <div>
        <?php if(auth()->guard()->check()): ?>
            <!-- Affiche le nom de l'utilisateur connecté -->
            <span class="text-light me-3">Bonjour, <?php echo e(Auth::user()->name); ?></span>

            <!-- Bouton Logout -->
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        <?php else: ?>
            <!-- Login/Register si personne n'est connecté -->
            <a href="<?php echo e(route('login')); ?>" class="btn btn-light btn-sm me-2">Login</a>
            <a href="<?php echo e(route('register')); ?>" class="btn btn-warning btn-sm">Register</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container mt-4">
    <?php echo $__env->yieldContent('content'); ?>
</div>

</body>
</html><?php /**PATH C:\projet d'integration\animal-center-main\resources\views/layouts/app.blade.php ENDPATH**/ ?>