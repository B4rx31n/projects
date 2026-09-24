// Sidebar Toggle Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar on button click
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // Restore sidebar state from localStorage
    if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        document.body.classList.add('sb-sidenav-toggled');
    }

    // Add active class to current page in sidebar
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.sb-sidenav-menu .nav-link');
    
    navLinks.forEach(link => {
        const linkPath = link.getAttribute('href');
        if (currentPath === linkPath || currentPath.startsWith(linkPath + '/')) {
            link.classList.add('active');
        }
    });

    // Auto-close sidebar on mobile when clicking outside
    document.addEventListener('click', function(e) {
        const sidebar = document.getElementById('sidenavAccordion');
        const sidebarToggleBtn = document.getElementById('sidebarToggle');
        
        if (window.innerWidth <= 768 && 
            !sidebar.contains(e.target) && 
            !sidebarToggleBtn.contains(e.target) &&
            document.body.classList.contains('sb-sidenav-toggled')) {
            document.body.classList.remove('sb-sidenav-toggled');
        }
    });
});

// Helper function for DataTables initialization
function initializeDataTable(tableId, options = {}) {
    const table = document.getElementById(tableId);
    if (table) {
        // Default options
        const defaultOptions = {
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            responsive: true
        };
        
        // Merge options
        const mergedOptions = { ...defaultOptions, ...options };
        
        // Initialize DataTable (assuming you have DataTables library loaded)
        if (typeof $ !== 'undefined' && $.fn.DataTable) {
            return $(table).DataTable(mergedOptions);
        }
    }
    return null;
}

// Form validation helper
function validateForm(formId, rules) {
    const form = document.getElementById(formId);
    if (form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const inputs = form.querySelectorAll('input, select, textarea');
            
            inputs.forEach(input => {
                if (rules[input.name] && !rules[input.name].test(input.value)) {
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Please fill all required fields correctly.');
            }
        });
    }
}