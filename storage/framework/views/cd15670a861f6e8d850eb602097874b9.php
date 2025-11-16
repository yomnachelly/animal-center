<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Animal Center</title>
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
                        <h4 class="mb-0">Inscription</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('register')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name')); ?>" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
                            </div>
                                <div class="mb-3">
                                        <label for="telephone" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="telephone" name="telephone" required>
                                    </div>

                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" id="adresse" name="adresse" required>
                                </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">S'inscrire</button>
                        </form>
                        <div class="mt-3 text-center">
                            <p>Déjà un compte ? <a href="<?php echo e(route('login')); ?>">Se connecter</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\projet d'integration\animal-center-main\resources\views/auth/register.blade.php ENDPATH**/ ?>