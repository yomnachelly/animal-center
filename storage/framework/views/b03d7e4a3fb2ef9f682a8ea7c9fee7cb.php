<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Animal Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark p-3">
        <a href="<?php echo e(route('home')); ?>" class="navbar-brand">Animal Center</a>
        <div>
            <a href="<?php echo e(route('login')); ?>" class="btn btn-light btn-sm">Login</a>
            <a href="<?php echo e(route('register')); ?>" class="btn btn-warning btn-sm">Register</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Connexion</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Se souvenir de moi</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                        </form>
                        <div class="mt-3 text-center">
                            <p>Pas de compte ? <a href="<?php echo e(route('register')); ?>">S'inscrire</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\projet d'integration\animal-center-main\resources\views/auth/login.blade.php ENDPATH**/ ?>