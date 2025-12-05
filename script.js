document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.sidebar li[data-page]');
    const pageContents = document.querySelectorAll('.page-content');
    const passwordToggles = document.querySelectorAll('.show-password');

    // --- 1. Fungsi Navigasi Halaman ---
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            const targetPageId = this.getAttribute('data-page');

            // Hapus kelas 'active' dari semua item navigasi
            navItems.forEach(nav => nav.classList.remove('active'));
            // Tambahkan kelas 'active' ke item yang diklik
            this.classList.add('active');

            // Sembunyikan semua konten halaman
            pageContents.forEach(content => content.classList.remove('active-page'));

            // Tampilkan konten halaman yang sesuai
            const targetPage = document.getElementById(targetPageId);
            if (targetPage) {
                targetPage.classList.add('active-page');
            }
        });
    });

    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);

            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash'); // Ganti ikon menjadi 'hide'
            } else {
                targetInput.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye'); // Ganti ikon menjadi 'show'
            }
        });
    });
});