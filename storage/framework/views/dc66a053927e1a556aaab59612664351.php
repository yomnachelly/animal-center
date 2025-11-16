<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dashboard Administrateur</h1>
        <span class="badge bg-danger">Admin</span>
    </div>

    <!-- Cards résumé -->
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Utilisateurs</h5>
                    <p class="card-text">Gérer les comptes</p>
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-light btn-sm">Voir</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Animaux</h5>
                    <p class="card-text">Gérer les animaux</p>
                    <a href="<?php echo e(route('animaux.index')); ?>" class="btn btn-light btn-sm">Voir</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">Demandes</h5>
                    <p class="card-text">Voir les demandes</p>
                    <a href="<?php echo e(route('admin.demandes.index')); ?>" class="btn btn-dark btn-sm">Voir</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <h5 class="card-title">Rapports</h5>
                    <p class="card-text">Statistiques</p>
                    <a href="#" class="btn btn-light btn-sm">Voir</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h3>Actions rapides</h3>
        <div class="dropdown">
            <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" id="actionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Sélectionner une action
            </button>
            <ul class="dropdown-menu" aria-labelledby="actionsDropdown">
                <li><a class="dropdown-item" href="<?php echo e(route('animaux.index')); ?>">Gérer les animaux</a></li>
                <li><a class="dropdown-item" href="<?php echo e(route('admin.users.index')); ?>">Voir les utilisateurs</a></li>
                <li><a class="dropdown-item" href="<?php echo e(route('admin.demandes.index')); ?>">Gérer les demandes</a></li>
                <li><a class="dropdown-item" href="#">Consulter les rapports</a></li>
            </ul>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projet d'integration\animal-center-main\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>