<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .sidebar {
            min-height: 80vh;
            border-right: 1px solid rgba(0,0,0,.1);
            padding-top: 1rem;
            background-color: #f8f9fa;
        }
        .sidebar a {
            display: block;
            padding: 0.75rem 1rem;
            color: #333;
            text-decoration: none;
            margin-bottom: 0.25rem;
            border-radius: 0.25rem;
        }
        .sidebar a.active, .sidebar a:hover {
            background-color: #0d6efd;
            color: white;
        }
        .notif-badge {
            position: absolute;
            top: 5px;
            right: 3px;
            font-size: 0.7rem;
        }
        .nav-brand { font-weight: 600; letter-spacing: .4px; }
        .dropdown {
    position: relative;
    display: inline-block;
}
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 200px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 4px;
}

.dropdown-menu a {
    display: block;
    padding: 10px 15px;
    text-decoration: none;
    color: #333;
    border-bottom: 1px solid #eee;
}

.dropdown-menu a:hover {
    background-color: #3811e4ff;
}

/* Classe pour garder le menu ouvert */
.dropdown-menu.show {
    display: block !important;
}

/* Ancien hover - vous pouvez le supprimer ou garder */
.dropdown:hover .dropdown-menu {
    display: block;
}
    </style>
   <script>
    function toggleDropdown() {
    event.preventDefault();
    const menu = document.getElementById('demandesMenu');
    menu.classList.toggle('show');
}

// Fermer le menu si on clique ailleurs sur la page
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('demandesDropdown');
    const menu = document.getElementById('demandesMenu');
    
    if (!dropdown.contains(event.target)) {
        menu.classList.remove('show');
    }
});
   </script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark p-3">
    <div class="container-fluid">
        <a href="<?php echo e(route('home')); ?>" class="navbar-brand nav-brand">Animal Center</a>
        <div class="d-flex align-items-center position-relative">
            
            <?php if(auth()->guard()->check()): ?>
                <?php
                    $role = Auth::user()->role ?? 'client';
                    $notifRoute = match($role) {
                        'admin' => 'admin.demandes.index',
                        'vet'   => 'vet.dashboard',
                        default => 'client.notifications',
                    };
                    $notifCollection = Auth::user()->notificationsReceived ?? Auth::user()->notifications ?? collect();
                    $notifCount = $notifCollection->count();
                ?>

                
                <div class="dropdown me-3">
                    <a class="btn btn-secondary btn-sm position-relative dropdown-toggle" href="#" role="button"
                       id="dropdownNotif" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="bi bi-bell"></span> <i class="fa-solid fa-bell fa-shake"></i>

                        <?php if($notifCount > 0): ?>
                            <span class="badge bg-danger notif-badge"><?php echo e($notifCount); ?></span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownNotif" style="min-width: 300px;">
                        <li class="dropdown-header">Notifications (<?php echo e($notifCount); ?>)</li>
                        <?php if($notifCollection->isEmpty()): ?>
                            <li class="px-3 py-2">Aucune notification</li>
                        <?php else: ?>
                            <?php $__currentLoopData = $notifCollection->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('client.notifications')); ?>">
                                        <?php echo e($n->data['message'] ?? $n->message ?? Str::limit($n->data['title'] ?? 'Nouvelle notification', 60)); ?>

                                        <br>
                                        <small class="text-muted"><?php echo e($n->created_at?->diffForHumans() ?? ''); ?></small>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a  href="<?php echo e(route('client.notifications')); ?>" class="btn btn-info">Voir toutes les notifications</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <span class="text-light me-3">Bonjour, <?php echo e(Auth::user()->name); ?></span>

                <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-light btn-sm me-2">Login</a>
                <a href="<?php echo e(route('register')); ?>" class="btn btn-warning btn-sm">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container-fluid mt-4">
    <div class="row">
        
        <div class="col-md-3 sidebar">
            <?php if(auth()->guard()->check()): ?>
                <?php $role = Auth::user()->role ?? 'client'; ?>

                <?php switch($role):
                    case ('admin'): ?>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                        <a href="<?php echo e(route('admin.users.index')); ?>" class="<?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>"><i class="fa-solid fa-users"></i> Utilisateurs</a>
                        <a href="<?php echo e(route('animaux.index')); ?>" class="<?php echo e(request()->routeIs('animaux.*') ? 'active' : ''); ?>"><i class="fa-solid fa-horse"></i> Animaux</a>
                        <a href="<?php echo e(route('admin.demandes.index')); ?>" class="<?php echo e(request()->routeIs('admin.demandes.*') ? 'active' : ''); ?>"><i class="fa-solid fa-file-lines"></i> Demandes</a>
                        <a href="<?php echo e(route('races.index')); ?>" class="<?php echo e(request()->routeIs('races.*') ? 'active' : ''); ?>"><i class="fa-solid fa-layer-group"></i> Races</a>
                        <a href="<?php echo e(route('especes.index')); ?>" class="<?php echo e(request()->routeIs('especes.*') ? 'active' : ''); ?>"><i class="fa-solid fa-shapes"></i> Espéces</a>
                        <a href="<?php echo e(route('avis.index')); ?>" class="<?php echo e(request()->routeIs('avis.*') ? 'active' : ''); ?>"><i class="fa-solid fa-star"></i> avis</a>
                        <a href="<?php echo e(route('admin.paiements.index')); ?>" class="<?php echo e(request()->routeIs('admin.paiements.*') ? 'active' : ''); ?>"><i class="fa-solid fa-money-bill-wave"></i> Frais de Paiements</a>
                        <?php break; ?>

                    <?php case ('vet'): ?>
                        <a href="<?php echo e(route('vet.dashboard')); ?>" class="<?php echo e(request()->routeIs('vet.dashboard') ? 'active' : ''); ?>"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                        <a href="<?php echo e(route('vet.soins.index')); ?>"class="<?php echo e(request()->routeIs('vet.soins.*') ? 'active' : ''); ?>"><i class="fa-solid fa-hand-holding-medical"></i> Soins</a>
                        <a href="<?php echo e(route('vet.vaccins.index')); ?>" class="<?php echo e(request()->routeIs('vet.vaccins.*') ? 'active' : ''); ?>"><i class="fa-solid fa-syringe"></i> Vaccins</a>
                        <a href="<?php echo e(route('vet.rendezvous.index')); ?>"  class="<?php echo e(request()->routeIs('vet.rendezvous.*') ? 'active' : ''); ?>"><i class="fa-solid fa-calendar-check"></i> rendezvous</a>
                        <a href="<?php echo e(route('vet.calendar')); ?>" class="<?php echo e(request()->routeIs('vet.calendar') ? 'active' : ''); ?>"><i class="fas fa-calendar-alt"></i> Calendrier</a>
                        <?php break; ?>
                        <?php break; ?>

                    <?php default: ?> 
                        <a href="<?php echo e(route('client.dashboard')); ?>" class="<?php echo e(request()->routeIs('client.dashboard') ? 'active' : ''); ?>"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                        <a href="<?php echo e(route('client.notifications')); ?>" class="<?php echo e(request()->routeIs('client.notifications') ? 'active' : ''); ?>"><i class="fa-solid fa-bell"></i>
 Notifications</a>
                       <a href="<?php echo e(route('client.rendez-vous')); ?>" class="<?php echo e(request()->routeIs('client.rendez-vous') ? 'active' : ''); ?>"><i class="fa-solid fa-calendar-check"></i> mes rendez vous</a>
                       <a href="<?php echo e(route('client.avis.index')); ?>" class="<?php echo e(request()->routeIs('client.avis.*') ? 'active' : ''); ?>"><i class="fa-solid fa-star"></i> Mes Avis</a>
                        <div class="dropdown" id="demandesDropdown">
    <a href="#" class="dropdown-toggle <?php echo e(request()->routeIs('client.demandes.*') ? 'active' : ''); ?>" onclick="toggleDropdown()">
        <i class="fa-solid fa-file-lines"></i> mes demandes
    </a>
    <div class="dropdown-menu" id="demandesMenu">
        <a href="<?php echo e(route('client.demandes.adoption')); ?>" class="<?php echo e(request()->routeIs('client.demandes.adoption') ? 'active' : ''); ?>">
            <i class="fa-solid fa-paw"></i> Adoption
        </a>
        <a href="<?php echo e(route('client.demandes.hebergement')); ?>" class="<?php echo e(request()->routeIs('client.demandes.hebergement') ? 'active' : ''); ?>">
            <i class="fa-solid fa-house-user"></i> Hébergement
        </a>
    </div>
</div>
                <?php endswitch; ?>
            <?php endif; ?>
        </div>

        
        <div class="col-md-9">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\projet d'integration\animal-center-main\resources\views/layouts/app.blade.php ENDPATH**/ ?>