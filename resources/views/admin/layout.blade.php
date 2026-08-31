<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} | Akyas Admin</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body">
    @auth
    <div class="admin-layout">
        <aside class="admin-sidebar" id="admin-sidebar">
            <div class="admin-sidebar__header">
                <a href="{{ route('admin.dashboard') }}" class="admin-logo">
                    <img src="{{ asset('images/logo-white.png') }}" alt="Akyas" width="40" height="40">
                    <span>Akyas Admin</span>
                </a>
                <button class="sidebar-close" id="sidebar-close" aria-label="Close sidebar">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <nav class="admin-nav">
                <a class="admin-nav__link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
                <a class="admin-nav__link {{ request()->routeIs('admin.products.*') ? 'is-active' : '' }}" href="{{ route('admin.products.index') }}">
                    <i class="fa-solid fa-box"></i>
                    <span>Products</span>
                </a>
                @if(auth()->user()->isAdmin())
                <a class="admin-nav__link {{ request()->routeIs('admin.product-categories.*') ? 'is-active' : '' }}" href="{{ route('admin.product-categories.index') }}">
                    <i class="fa-solid fa-tags"></i>
                    <span>Product Categories</span>
                </a>
                @endif
                <a class="admin-nav__link {{ request()->routeIs('admin.blog.*') ? 'is-active' : '' }}" href="{{ route('admin.blog.index') }}">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Blog Posts</span>
                </a>
                @if(auth()->user()->isAdmin())
                <a class="admin-nav__link {{ request()->routeIs('admin.blog-categories.*') ? 'is-active' : '' }}" href="{{ route('admin.blog-categories.index') }}">
                    <i class="fa-solid fa-folder"></i>
                    <span>Blog Categories</span>
                </a>
                @endif
                @if(auth()->user()->isAdmin())
                <a class="admin-nav__link {{ request()->routeIs('admin.enquiries.*') ? 'is-active' : '' }}" href="{{ route('admin.enquiries.index') }}">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Enquiries</span>
                    @if($unreadCount > 0)
                        <span class="admin-badge">{{ $unreadCount }}</span>
                    @endif
                </a>
                @endif
                <a class="admin-nav__link {{ request()->routeIs('admin.certificates.*') ? 'is-active' : '' }}" href="{{ route('admin.certificates.index') }}">
                    <i class="fa-solid fa-certificate"></i>
                    <span>Certificates</span>
                </a>
                @if(auth()->user()->isAdmin())
                <a class="admin-nav__link {{ request()->routeIs('admin.staff-users.*') ? 'is-active' : '' }}" href="{{ route('admin.staff-users.index') }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Staff Users</span>
                </a>
                @endif
            </nav>
            <div class="admin-sidebar__footer">
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.profile') }}" class="admin-nav__link {{ request()->routeIs('admin.profile') ? 'is-active' : '' }}">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Profile Setting</span>
                </a>
                @endif
                <a href="{{ route('home') }}" target="_blank" class="admin-nav__link">
                    <i class="fa-solid fa-external-link"></i>
                    <span>View Site</span>
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="admin-nav__link">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <header class="admin-topbar">
                <button class="menu-toggle" id="menu-toggle" aria-label="Toggle sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="admin-topbar__right">
                    <span class="admin-user">
                        {{ auth()->user()->name }}
                        <span class="badge badge--small {{ auth()->user()->isAdmin() ? 'badge--primary' : 'badge--secondary' }}">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </span>
                </div>
            </header>

            <div class="admin-content">
                @if(session('success'))
                    <div class="alert alert--success">
                        <i class="fa-solid fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert--error">
                        <i class="fa-solid fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert--error">
                        <i class="fa-solid fa-exclamation-circle"></i>
                        Please fix the following errors:
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="admin-modal" id="deleteModal">
        <div class="admin-modal__overlay"></div>
        <div class="admin-modal__content">
            <div class="admin-modal__icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3 class="admin-modal__title">Confirm Delete</h3>
            <p class="admin-modal__text" id="deleteModalText">Are you sure you want to delete this item? This action cannot be undone.</p>
            <div class="admin-modal__actions">
                <button type="button" class="btn btn--ghost" onclick="closeDeleteModal()">Cancel</button>
                <form id="deleteModalForm" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn--danger">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('admin-sidebar');
        const sidebarClose = document.getElementById('sidebar-close');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => sidebar.classList.toggle('is-open'));
        }
        if (sidebarClose) {
            sidebarClose.addEventListener('click', () => sidebar.classList.remove('is-open'));
        }

        // Delete confirmation modal
        function openDeleteModal(url, itemName) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteModalForm');
            const text = document.getElementById('deleteModalText');
            form.action = url;
            text.textContent = itemName
                ? 'Are you sure you want to delete "' + itemName + '"? This action cannot be undone.'
                : 'Are you sure you want to delete this item? This action cannot be undone.';
            modal.classList.add('is-open');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('is-open');
        }

        document.querySelector('#deleteModal .admin-modal__overlay')?.addEventListener('click', closeDeleteModal);

        // Image upload preview
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const previewId = this.dataset.preview;
                if (!previewId) return;
                const preview = document.getElementById(previewId);
                if (!preview) return;
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        // Form submit disable (prevent double submission)
        document.querySelectorAll('form[data-disable-on-submit]').forEach(form => {
            form.addEventListener('submit', function() {
                const btn = this.querySelector('button[type="submit"]');
                if (btn && !btn.disabled) {
                    btn.disabled = true;
                    btn.dataset.originalText = btn.innerHTML;
                    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Saving...';
                }
            });
        });
    </script>
    @else
        @yield('auth-content')
    @endauth
</body>
</html>
