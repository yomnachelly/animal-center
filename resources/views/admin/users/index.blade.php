@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <style>
        .users-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(111, 66, 193, 0.3);
        }
        
        .page-title {
            font-weight: 700;
            margin: 0;
            font-size: 2.2rem;
        }
        
        .btn-primary-custom {
            background: white;
            color: #6f42c1;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
            background: #f8f9fa;
            color: #6f42c1;
        }
        
        .alert-success-custom {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border: none;
            border-left: 5px solid #28a745;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.2);
        }
        
        .users-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .users-table thead {
            background: linear-gradient(135deg, #6f42c1, #5a2d91);
        }
        
        .users-table thead th {
            border: none;
            padding: 20px 15px;
            font-weight: 600;
            color: white;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .users-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .users-table tbody tr:hover {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            transform: translateX(5px);
        }
        
        .users-table tbody td {
            border: none;
            padding: 20px 15px;
            vertical-align: middle;
            font-size: 1rem;
        }
        
        .user-name {
            font-weight: 600;
            color: #6f42c1;
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 12px;
            font-size: 1.1rem;
        }
        
        .user-email {
            color: #495057;
            font-weight: 500;
        }
        
        .role-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .role-admin {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
        }
        
        .role-vet {
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
        }
        
        .role-client {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .user-contact {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .verrouille-badge {
            padding: 6px 12px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        
        .verrouille-oui {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
        }
        
        .verrouille-non {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            border: none;
            color: #212529;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
            color: #212529;
        }
        
        .btn-lock {
            background: linear-gradient(135deg, #6c757d, #868e96);
            border: none;
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-lock:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
        }
        
        .btn-unlock {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-unlock:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            margin: 20px 0;
        }
        
        .empty-state-icon {
            font-size: 4rem;
            color: #6c757d;
            margin-bottom: 20px;
        }
        
        .empty-state-title {
            color: #495057;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .empty-state-text {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #6f42c1;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
        }
        
        .filter-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }
        
        .filter-title {
            color: #495057;
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        
        .filter-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .filter-btn {
            padding: 8px 20px;
            border: 2px solid #e9ecef;
            border-radius: 25px;
            background: white;
            color: #6c757d;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .filter-btn:hover, .filter-btn.active {
            background: #6f42c1;
            color: white;
            border-color: #6f42c1;
        }
        
        .active-filter-badge {
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-left: 10px;
        }
        
        @media (max-width: 768px) {
            .page-header {
                padding: 20px;
                text-align: center;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .users-table thead th,
            .users-table tbody td {
                padding: 15px 8px;
                font-size: 0.9rem;
            }
            
            .filter-buttons {
                flex-direction: column;
            }
            
            .filter-btn {
                text-align: center;
            }
        }
    </style>

    <div class="users-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-users me-2"></i>👥 Gestion des Utilisateurs
                    </h1>
                    <!-- Correction : utilisation de isset() pour vérifier la variable -->
                    @if(isset($role) && $role)
                        <div class="mt-2">
                            <span class="active-filter-badge">
                                <i class="fas fa-filter me-1"></i>
                                Filtre actif : {{ $role }}
                            </span>
                        </div>
                    @endif
                </div>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-user-plus me-2"></i>Nouvel Utilisateur
                </a>
            </div>
        </div>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert alert-success-custom">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-3 text-success" style="font-size: 1.5rem;"></i>
                    <div>
                        <h5 class="mb-1 text-success">Succès !</h5>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Cartes de statistiques -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-number">{{ $users->count() }}</div>
                <div class="stat-label">Utilisateurs Total</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $users->where('role', 'admin')->count() }}</div>
                <div class="stat-label">Administrateurs</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $users->where('role', 'vet')->count() }}</div>
                <div class="stat-label">Vétérinaires</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $users->where('role', 'client')->count() }}</div>
                <div class="stat-label">Clients</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $users->where('verrouiller', 0)->count() }}</div>
                <div class="stat-label">Comptes Actifs</div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="filter-section">
            <h5 class="filter-title">
                <i class="fas fa-filter me-2"></i>Filtrer par rôle
            </h5>
            <div class="filter-buttons">
                <!-- Correction : utilisation de request() pour les URLs de filtre -->
                <a href="{{ route('admin.users.index') }}" class="filter-btn {{ !request('role') ? 'active' : '' }}">
                    <i class="fas fa-layer-group me-1"></i>Tous
                    <span class="badge bg-light text-dark ms-1">{{ \App\Models\User::count() }}</span>
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" class="filter-btn {{ request('role') == 'admin' ? 'active' : '' }}">
                    <i class="fas fa-shield-alt me-1"></i>Administrateurs
                    <span class="badge bg-light text-dark ms-1">{{ \App\Models\User::where('role', 'admin')->count() }}</span>
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'vet']) }}" class="filter-btn {{ request('role') == 'vet' ? 'active' : '' }}">
                    <i class="fas fa-user-md me-1"></i>Vétérinaires
                    <span class="badge bg-light text-dark ms-1">{{ \App\Models\User::where('role', 'vet')->count() }}</span>
                </a>
                <a href="{{ route('admin.users.index', ['role' => 'client']) }}" class="filter-btn {{ request('role') == 'client' ? 'active' : '' }}">
                    <i class="fas fa-user me-1"></i>Clients
                    <span class="badge bg-light text-dark ms-1">{{ \App\Models\User::where('role', 'client')->count() }}</span>
                </a>
            </div>
        </div>

        <!-- Tableau des utilisateurs -->
        @if($users->count() > 0)
            <div class="users-table">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 20%;">Utilisateur</th>
                            <th style="width: 20%;">Email</th>
                            <th style="width: 12%;">Rôle</th>
                            <th style="width: 13%;">Téléphone</th>
                            <th style="width: 15%;">Adresse</th>
                            <th style="width: 10%;">Statut</th>
                            <th style="width: 20%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="user-name">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="user-email">
                                        <i class="fas fa-envelope me-1 text-muted"></i>
                                        {{ $user->email }}
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $roleClass = match($user->role) {
                                            'admin' => 'role-admin',
                                            'vet' => 'role-vet',
                                            'client' => 'role-client',
                                            default => 'role-client'
                                        };
                                    @endphp
                                    <span class="role-badge {{ $roleClass }}">
                                        <i class="fas 
                                            @if($user->role == 'admin') fa-shield-alt 
                                            @elseif($user->role == 'vet') fa-user-md 
                                            @else fa-user 
                                            @endif me-1">
                                        </i>
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td>
                                    <div class="user-contact">
                                        <i class="fas fa-phone me-1 text-muted"></i>
                                        {{ $user->telephone ?? '-' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="user-contact">
                                        <i class="fas fa-map-marker-alt me-1 text-muted"></i>
                                        {{ $user->adresse ? \Illuminate\Support\Str::limit($user->adresse, 20) : '-' }}
                                    </div>
                                </td>
                                <td>
                                    @if($user->verrouiller)
                                        <span class="verrouille-badge verrouille-oui">
                                            <i class="fas fa-lock me-1"></i>Verrouillé
                                        </span>
                                    @else
                                        <span class="verrouille-badge verrouille-non">
                                            <i class="fas fa-unlock me-1"></i>Actif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn-edit">
                                            <i class="fas fa-edit me-1"></i>Modifier
                                        </a>

                                        @if(!$user->verrouiller)
                                            <form action="{{ route('admin.users.verrouiller', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn-lock" 
                                                        onclick="return confirm('Êtes-vous sûr de vouloir verrouiller ce compte ?')">
                                                    <i class="fas fa-lock me-1"></i>Bloquer
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.deverrouiller', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn-unlock"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir déverrouiller ce compte ?')">
                                                    <i class="fas fa-unlock me-1"></i>Débloquer
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- État vide -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-users-slash"></i>
                </div>
                <h3 class="empty-state-title">Aucun utilisateur trouvé</h3>
                <p class="empty-state-text">
                    <!-- Correction : utilisation de request() au lieu de $role -->
                    @if(request('role'))
                        Aucun utilisateur avec le rôle "{{ request('role') }}" n'a été trouvé.
                    @else
                        Aucun utilisateur n'est enregistré dans le système.
                    @endif
                </p>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-user-plus me-2"></i>Ajouter le premier utilisateur
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des cartes de statistiques
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.2}s`;
        });
        
        // Confirmation pour le verrouillage/déverrouillage
        const lockForms = document.querySelectorAll('form[action*="verrouiller"]');
        const unlockForms = document.querySelectorAll('form[action*="deverrouiller"]');
        
        lockForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const userName = this.closest('tr').querySelector('.user-name').textContent.trim();
                if (!confirm(`Êtes-vous sûr de vouloir verrouiller le compte de "${userName}" ?\n\nL'utilisateur ne pourra plus se connecter.`)) {
                    e.preventDefault();
                }
            });
        });
        
        unlockForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const userName = this.closest('tr').querySelector('.user-name').textContent.trim();
                if (!confirm(`Êtes-vous sûr de vouloir déverrouiller le compte de "${userName}" ?\n\nL'utilisateur pourra à nouveau se connecter.`)) {
                    e.preventDefault();
                }
            });
        });
        
        // Effet de pulse sur les avatars
        const userAvatars = document.querySelectorAll('.user-avatar');
        userAvatars.forEach((avatar, index) => {
            avatar.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@endsection