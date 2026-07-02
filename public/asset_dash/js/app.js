
document.addEventListener('DOMContentLoaded', () => {
    // 1. Sidebar Toggle
    const sidebar = document.querySelector('.sidebar');
    const menuToggle = document.querySelector('.menu-toggle');
    const closeSidebar = document.querySelector('.close-sidebar');

    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 768 &&
            sidebar &&
            sidebar.classList.contains('active') &&
            !sidebar.contains(e.target) &&
            !menuToggle.contains(e.target)) {
            sidebar.classList.remove('active');
        }
    });

    // 2. Active Link Highlighting
    const currentPath = window.location.pathname.split('/').pop() || 'index.html';
    const menuLinks = document.querySelectorAll('.menu-link');

    menuLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });

    // 3. Theme Switching
    const themeToggle = document.querySelector('#theme-toggle');
    const root = document.documentElement;

    // Check saved theme
    const savedTheme = localStorage.getItem('theme') || 'light';
    root.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const currentTheme = root.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            root.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });
    }

    function updateThemeIcon(theme) {
        if (!themeToggle) return;
        const icon = themeToggle.querySelector('i');
        if (theme === 'dark') {
            icon.className = 'fas fa-sun';
        } else {
            icon.className = 'fas fa-moon';
        }
    }

    // 4. Image Preview
    const imageInput = document.querySelector('input[type="file"][accept="image/*"]');
    const imagePreview = document.querySelector('.image-preview');

    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // 5. Basic Form Validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            let isValid = true;
            const requiredInputs = form.querySelectorAll('[required]');

            requiredInputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = 'red';
                } else {
                    input.style.borderColor = '';
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    });

    // 6. Simple Chart Animation (On Dashboard Home)
    const bars = document.querySelectorAll('.bar');
    if (bars.length > 0) {
        setTimeout(() => {
            bars.forEach(bar => {
                const height = bar.getAttribute('data-height');
                bar.style.height = height;
            });
        }, 500);
    }

    // 7. SEO Keywords Tag Input
    const tagInput = document.getElementById('keyword-input');
    const tagContainer = document.querySelector('.tag-container');

    if (tagInput && tagContainer) {
        tagInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                const text = tagInput.value.trim();

                if (text) {
                    const tag = document.createElement('div');
                    tag.classList.add('tag');
                    tag.innerHTML = `
                        ${text}
                        <span class="tag-close">&times;</span>
                    `;

                    tag.querySelector('.tag-close').addEventListener('click', () => {
                        tag.remove();
                    });

                    tagContainer.insertBefore(tag, tagInput);
                    tagInput.value = '';
                }
            }
        });
    }
});
