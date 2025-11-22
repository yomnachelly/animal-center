<?php $__env->startSection('content'); ?>

<h1 class="mb-4">Bienvenue au Refuge Animalier</h1>


<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    
    <div class="col-md-8">

        
        <div class="mt-5">
            <h2 class="mb-4">Animaux à adopter</h2>

            <?php if($featuredAnimals->count() > 0): ?>
                <div class="row">
                    <?php $__currentLoopData = $featuredAnimals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 mb-4">
                            <div class="card h-100" data-animal-id="<?php echo e($animal->id); ?>">
                                <?php if($animal->photo): ?>
                                    <img src="<?php echo e(asset('storage/' . $animal->photo)); ?>" class="card-img-top" alt="<?php echo e($animal->nom); ?>">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/default-animal.png')); ?>" class="card-img-top" alt="<?php echo e($animal->nom); ?>">
                                <?php endif; ?>

                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($animal->nom); ?></h5>
                                    <p class="card-text">
                                        <strong>Espèce :</strong> <?php echo e($animal->espece->nom ?? '-'); ?><br>
                                        <strong>Race :</strong> <?php echo e($animal->race->nom ?? '-'); ?><br>
                                        <strong>Âge :</strong> <?php echo e($animal->age ?? 'Inconnu'); ?> ans<br>
                                        <strong>Sexe :</strong> <?php echo e(ucfirst($animal->sexe)); ?>

                                    </p>
                                </div>

                                
                                <div class="card-footer text-center">
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php
                                            $hasDemande = auth()->user()->demandes()->where('animal_id', $animal->id)->exists();
                                        ?>

                                        <?php if($hasDemande): ?>
                                            <button class="btn btn-secondary btn-sm" disabled>Demande envoyée</button>
                                            <small class="d-block text-muted mt-1">En attente de validation</small>
                                        <?php else: ?>
                                            <form action="<?php echo e(route('demande.adopter', $animal)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-success btn-sm" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir faire une demande d\\'adoption pour <?php echo e($animal->nom); ?> ?')">
                                                    Demander
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('login')); ?>" class="btn btn-success btn-sm">Demander</a>
                                        <small class="d-block text-muted mt-1">Connectez-vous pour adopter</small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="text-center mt-3">
                    <a href="<?php echo e(route('animaux.index')); ?>" class="btn btn-outline-primary">Voir tous les animaux</a>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    Aucun animal disponible pour le moment.
                </div>
            <?php endif; ?>
        </div>

        
        <div class="mt-5">
            <h2 class="mb-4">Avis de nos clients</h2>

            <?php if($derniersAvis->count() > 0): ?>
                <div class="row">
                    <?php $__currentLoopData = $derniersAvis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 40px; height: 40px; font-weight: bold;">
                                            <?php echo e(strtoupper(substr($avis->user->name, 0, 1))); ?>

                                        </div>
                                        <h5 class="card-title mb-0"><?php echo e($avis->user->name); ?></h5>
                                    </div>
                                    <p class="card-text"><?php echo e($avis->texte); ?></p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        <?php echo e($avis->created_at ? $avis->created_at->diffForHumans() : 'Date non disponible'); ?>

                                    </small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if(auth()->guard()->check()): ?>
                    <div class="text-center mt-3">
                        <a href="<?php echo e(route('client.avis.index')); ?>" class="btn btn-outline-primary">
                            Voir tous les avis
                        </a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun avis pour le moment.
                    <?php if(auth()->guard()->check()): ?>
                        Soyez le premier à donner votre avis !
                    <?php else: ?>
                        Connectez-vous pour donner votre avis !
                    <?php endif; ?>
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

        
        <div class="mt-4 p-3 bg-light rounded">
            <h5>Notre Refuge en Chiffres</h5>
            <div class="row text-center">
                <div class="col-6">
                    <div class="p-2">
                        <h4 class="text-primary mb-1"><?php echo e(App\Models\Animal::count()); ?></h4>
                        <small>Animaux sauvés</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-2">
                        <h4 class="text-success mb-1"><?php echo e(App\Models\Avis::count()); ?></h4>
                        <small>Avis clients</small>
                    </div>
                </div>
            </div>
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


<?php if(session('scroll_to_animal')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const animalId = <?php echo e(session('scroll_to_animal')); ?>;
            const animalCard = document.querySelector(`[data-animal-id="${animalId}"]`);
            if (animalCard) {
                animalCard.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'center'
                });
                
                // Effet visuel
                animalCard.style.transition = 'all 0.5s ease';
                animalCard.style.boxShadow = '0 0 20px rgba(0,255,0,0.5)';
                
                setTimeout(() => { animalCard.style.boxShadow = ''; }, 2000);
            }
        }, 500);
    });
</script>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projet d'integration\animal-center-main\resources\views/welcome.blade.php ENDPATH**/ ?>