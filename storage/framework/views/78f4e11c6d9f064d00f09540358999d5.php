<?php $__env->startSection('content'); ?>

<h1 class="mb-4">Bienvenue au Refuge Animalier</h1>

<div class="row">
    <div class="col-md-8">
        <h2 class="mb-4">Animaux à adopter</h2>
        
        <div class="row">
            <?php if(isset($featuredAnimals) && $featuredAnimals->count() > 0): ?>
                <?php $__currentLoopData = $featuredAnimals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($animal->name); ?></h5>
                                <p class="card-text">
                                    <strong>Espèce:</strong> <?php echo e($animal->espece); ?><br>
                                    <strong>Race:</strong> <?php echo e($animal->race ?? 'Non spécifiée'); ?><br>
                                    <strong>Âge:</strong> <?php echo e($animal->age ?? 'Non spécifié'); ?>

                                </p>
                                <p class="card-text"><?php echo e($animal->description); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        Aucun animal disponible pour le moment. Revenez bientôt !
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="col-md-4">
        <h2 class="mb-4">Services disponibles</h2>
        
        <div class="list-group">
            <div class="list-group-item">Soin vétérinaire</div>
            <div class="list-group-item">Vaccination</div>
            <div class="list-group-item">Hébergement</div>
            <div class="list-group-item">Adoption</div>
            <div class="list-group-item">Conseils animaliers</div>
        </div>

        <?php if(auth()->guard()->guest()): ?>
        <div class="mt-4 p-3 bg-light rounded">
            <h5>Rejoignez-nous !</h5>
            <p>Créez un compte pour adopter un animal ou utiliser nos services.</p>
            <a href="/register" class="btn btn-warning">Créer un compte</a>
            <a href="/login" class="btn btn-outline-secondary">Se connecter</a>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projet d'integration\animal-center-main\resources\views/welcome.blade.php ENDPATH**/ ?>