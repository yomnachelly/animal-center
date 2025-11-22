<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-0">Espace Administrateur</h1>
            <p class="text-muted mt-1">
                Interface de gestion du système — consultez les statistiques, surveillez les activités 
                et accédez aux fonctionnalités essentielles du centre.
            </p>
        </div>

        <span class="badge bg-danger fs-6 px-3 py-2 shadow-sm">
            <i class="bi bi-shield-lock-fill me-1"></i> Administrateur
        </span>
    </div>
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h4 class="fw-semibold">Bienvenue dans votre tableau de bord</h4>
            <p class="text-muted mb-0">
                Cette interface regroupe toutes les informations essentielles pour superviser 
                le fonctionnement du refuge.  
                Utilisez le menu pour accéder aux animaux, aux demandes d’adoption, aux avis, 
                ainsi qu’aux différentes sections d’administration.
            </p>
        </div>
    </div>


</div>

<style>
    .hover-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projet d'integration\animal-center-main\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>