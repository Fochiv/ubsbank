// =====================================================
// UBS BANK - GESTION DU THÈME ET INTERACTIONS
// =====================================================

document.addEventListener('DOMContentLoaded', function() {
    
    // =====================================================
    // GESTION DU THÈME DARK/LIGHT
    // =====================================================
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    
    // Charger le thème sauvegardé (dark par défaut)
    const savedTheme = localStorage.getItem('theme') || 'dark';
    document.documentElement.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);
    
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });
    }
    
    function updateThemeIcon(theme) {
        if (themeIcon) {
            if (theme === 'dark') {
                themeIcon.className = 'bi bi-sun-fill';
            } else {
                themeIcon.className = 'bi bi-moon-stars-fill';
            }
        }
    }
    
    // =====================================================
    // RECHERCHE DANS LES TABLEAUX
    // =====================================================
    const searchInputs = document.querySelectorAll('.search-input');
    
    searchInputs.forEach(searchInput => {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const table = this.closest('.card').querySelector('.modern-table tbody');
            const rows = table.querySelectorAll('tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    
    // =====================================================
    // CONFIRMATION DE SUPPRESSION
    // =====================================================
    window.confirmDelete = function(identifiant, nom, prenom) {
        const modal = document.getElementById('delete-modal');
        const modalText = document.getElementById('delete-modal-text');
        const confirmBtn = document.getElementById('confirm-delete-btn');
        
        if (modal && modalText && confirmBtn) {
            modalText.textContent = `Êtes-vous sûr de vouloir supprimer la transaction de ${nom} ${prenom} (ID: ${identifiant}) ?`;
            confirmBtn.setAttribute('data-id', identifiant);
            modal.classList.add('active');
        }
    }
    
    window.closeModal = function() {
        const modal = document.getElementById('delete-modal');
        if (modal) {
            modal.classList.remove('active');
        }
    }
    
    window.confirmDeleteAction = function() {
        const confirmBtn = document.getElementById('confirm-delete-btn');
        const identifiant = confirmBtn.getAttribute('data-id');
        
        if (identifiant) {
            window.location.href = `delete_transaction.php?id=${identifiant}`;
        }
    }
    
    // =====================================================
    // SIDEBAR TOGGLE POUR MOBILE
    // =====================================================
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }
    
    // =====================================================
    // ANIMATION DES CARTES AU SCROLL
    // =====================================================
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('slide-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.stat-card, .card').forEach(el => {
        observer.observe(el);
    });
    
    // =====================================================
    // VALIDATION DES FORMULAIRES
    // =====================================================
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = 'var(--accent-danger)';
                } else {
                    field.style.borderColor = 'var(--border-color)';
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Veuillez remplir tous les champs obligatoires');
            }
        });
    });
});
