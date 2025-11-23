<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <style>
        .admin-dashboard {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3);
        }
        
        .page-title {
            font-weight: 700;
            margin: 0;
            font-size: 2.2rem;
        }
        
        .admin-badge {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .welcome-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border-left: 5px solid #dc3545;
        }
        
        .welcome-title {
            color: #dc3545;
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.4rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-top: 4px solid;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: inherit;
        }
        
        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .stat-card.primary {
            border-color: #dc3545;
        }
        
        .stat-card.success {
            border-color: #28a745;
        }
        
        .stat-card.warning {
            border-color: #ffc107;
        }
        
        .stat-card.info {
            border-color: #17a2b8;
        }
        
        .stat-card.purple {
            border-color: #6f42c1;
        }
        
        .stat-card.orange {
            border-color: #fd7e14;
        }
        
        .stat-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        
        .stat-icon.primary {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
        }
        
        .stat-icon.success {
            background: linear-gradient(135deg, #28a745, #20c997);
        }
        
        .stat-icon.warning {
            background: linear-gradient(135deg, #ffc107, #ffb300);
        }
        
        .stat-icon.info {
            background: linear-gradient(135deg, #17a2b8, #138496);
        }
        
        .stat-icon.purple {
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
        }
        
        .stat-icon.orange {
            background: linear-gradient(135deg, #fd7e14, #e9690c);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
            line-height: 1;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 500;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-trend {
            display: flex;
            align-items: center;
            font-size: 0.85rem;
            font-weight: 500;
            margin-top: 8px;
        }
        
        .trend-up {
            color: #28a745;
        }
        
        .trend-down {
            color: #dc3545;
        }
        
        .charts-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .chart-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }
        
        .chart-title {
            color: #495057;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }
        
        .chart-title i {
            margin-right: 10px;
            color: #dc3545;
        }
        
        .mini-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        
        .mini-stat {
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid;
        }
        
        .mini-stat.attente {
            border-color: #ffc107;
        }
        
        .mini-stat.accepte {
            border-color: #28a745;
        }
        
        .mini-stat.refuse {
            border-color: #dc3545;
        }
        
        .mini-stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .mini-stat-label {
            font-size: 0.8rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .quick-actions {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }
        
        .actions-title {
            color: #495057;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.3rem;
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            text-decoration: none;
            color: #495057;
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .action-btn:hover {
            background: white;
            border-color: #dc3545;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }
        
        .action-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #dc3545;
        }
        
        .action-label {
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .page-header {
                padding: 20px;
                text-align: center;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .charts-section {
                grid-template-columns: 1fr;
            }
            
            .actions-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .stat-number {
                font-size: 2rem;
            }
        }
        
        .progress-ring {
            width: 60px;
            height: 60px;
        }
    </style>

    <div class="admin-dashboard">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="page-title">🛡️ Espace Administrateur</h1>
                </div>
                <span class="admin-badge">
                    <i class="fas fa-shield-alt me-2"></i>Administrateur
                </span>
            </div>
        </div>

        <!-- Carte de bienvenue -->


        <!-- Grille des statistiques principales -->
        <div class="stats-grid">
            <!-- Espèces -->
            <div class="stat-card primary">
                <div class="stat-header">
                    <div class="stat-icon primary">
                        <i class="fas fa-paw"></i>
                    </div>
                </div>
                <div class="stat-number"><?php echo e($stats['especes_count']); ?></div>
                <div class="stat-label">Espèces Différentes</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-seedling me-1"></i>
                    Diversité animale
                </div>
            </div>

            <!-- Animaux -->
            <div class="stat-card success">
                <div class="stat-header">
                    <div class="stat-icon success">
                        <i class="fas fa-paw"></i>
                    </div>
                </div>
                <div class="stat-number"><?php echo e($stats['animaux_count']); ?></div>
                <div class="stat-label">Animaux au Refuge</div>
                <div class="stat-trend">
                    <i class="fas fa-home me-1"></i>
                    <?php echo e($stats['animaux_adoptables']); ?> adoptables
                </div>
            </div>

            <!-- Races -->
            <div class="stat-card warning">
                <div class="stat-header">
                    <div class="stat-icon warning">
                        <i class="fas fa-dna"></i>
                    </div>
                </div>
                <div class="stat-number"><?php echo e($stats['races_count']); ?></div>
                <div class="stat-label">Races Recensées</div>
                <div class="stat-trend">
                    <i class="fas fa-list me-1"></i>
                    Variétés disponibles
                </div>
            </div>

            <!-- Utilisateurs actifs -->
            <div class="stat-card info">
                <div class="stat-header">
                    <div class="stat-icon info">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-number"><?php echo e($stats['users_actifs']); ?></div>
                <div class="stat-label">Utilisateurs Actifs</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-user-check me-1"></i>
                    Communauté engagée
                </div>
            </div>

            <!-- Demandes -->
            <div class="stat-card purple">
                <div class="stat-header">
                    <div class="stat-icon purple">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                </div>
                <div class="stat-number"><?php echo e($stats['demandes_total']); ?></div>
                <div class="stat-label">Demandes Total</div>
                <div class="stat-trend">
                    <i class="fas fa-chart-line me-1"></i>
                    <?php echo e($stats['demandes_acceptees']); ?> acceptées
                </div>
            </div>

            <!-- Avis -->
            <div class="stat-card orange">
                <div class="stat-header">
                    <div class="stat-icon orange">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="stat-number"><?php echo e($stats['avis_count']); ?></div>
                <div class="stat-label">Avis Clients</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-comments me-1"></i>
                    Satisfaction mesurée
                </div>
            </div>
        </div>

        <!-- Section des graphiques et détails -->
        <div class="charts-section">
            <!-- Statistiques des demandes -->
            <div class="chart-card">
                <h4 class="chart-title">
                    <i class="fas fa-chart-bar"></i>Statistiques des Demandes
                </h4>
                <div class="mini-stats">
                    <div class="mini-stat attente">
                        <div class="mini-stat-number"><?php echo e($stats['demandes_attente']); ?></div>
                        <div class="mini-stat-label">En Attente</div>
                    </div>
                    <div class="mini-stat accepte">
                        <div class="mini-stat-number"><?php echo e($stats['demandes_acceptees']); ?></div>
                        <div class="mini-stat-label">Acceptées</div>
                    </div>
                    <div class="mini-stat refuse">
                        <div class="mini-stat-number"><?php echo e($stats['demandes_refusees']); ?></div>
                        <div class="mini-stat-label">Refusées</div>
                    </div>
                </div>
            </div>

            <!-- Statistiques des rendez-vous -->
            <div class="chart-card">
                <h4 class="chart-title">
                    <i class="fas fa-calendar-check"></i>Statistiques des Rendez-vous
                </h4>
                <div class="mini-stats">
                    <div class="mini-stat attente">
                        <div class="mini-stat-number"><?php echo e($stats['rdv_attente']); ?></div>
                        <div class="mini-stat-label">En Attente</div>
                    </div>
                    <div class="mini-stat accepte">
                        <div class="mini-stat-number"><?php echo e($stats['rdv_acceptes']); ?></div>
                        <div class="mini-stat-label">Acceptés</div>
                    </div>
                    <div class="mini-stat refuse">
                        <div class="mini-stat-number"><?php echo e($stats['rdv_refuses']); ?></div>
                        <div class="mini-stat-label">Refusés</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="quick-actions">
            <h4 class="actions-title">
                <i class="fas fa-bolt me-2"></i>Actions Rapides
            </h4>
            <div class="actions-grid">
                <a href="<?php echo e(route('animaux.index')); ?>" class="action-btn">
                    <i class="fas fa-paw action-icon"></i>
                    <span class="action-label">Gérer les Animaux</span>
                </a>
                <a href="<?php echo e(route('admin.demandes.index')); ?>" class="action-btn">
                    <i class="fas fa-hand-holding-heart action-icon"></i>
                    <span class="action-label">Demandes Adoption</span>
                </a>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="action-btn">
                    <i class="fas fa-users action-icon"></i>
                    <span class="action-label">Utilisateurs</span>
                </a>
                <a href="<?php echo e(route('avis.index')); ?>" class="action-btn">
                    <i class="fas fa-star action-icon"></i>
                    <span class="action-label">Avis Clients</span>
                </a>
                <a href="<?php echo e(route('especes.index')); ?>" class="action-btn">
                    <i class="fas fa-list action-icon"></i>
                    <span class="action-label">Espèces</span>
                </a>
                <a href="<?php echo e(route('races.index')); ?>" class="action-btn">
                    <i class="fas fa-dna action-icon"></i>
                    <span class="action-label">Races</span>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des cartes de statistiques
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Effet de comptage pour les statistiques
        const statNumbers = document.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
            const target = parseInt(stat.textContent);
            const duration = 2000;
            const steps = 60;
            const step = target / steps;
            let current = 0;
            
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    stat.textContent = target;
                    clearInterval(timer);
                } else {
                    stat.textContent = Math.floor(current);
                }
            }, duration / steps);
        });
        
        // Effet de hover amélioré pour les actions
        const actionBtns = document.querySelectorAll('.action-btn');
        actionBtns.forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                const icon = this.querySelector('.action-icon');
                icon.style.transform = 'scale(1.2)';
            });
            
            btn.addEventListener('mouseleave', function() {
                const icon = this.querySelector('.action-icon');
                icon.style.transform = 'scale(1)';
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\projet d'integration\animal-center-main\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>