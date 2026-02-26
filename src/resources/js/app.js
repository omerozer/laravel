import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    initThemeToggle();
    initEditModal();
});

function initThemeToggle() {
    const root = document.documentElement;
    const preferred = localStorage.getItem('theme');

    if (preferred === 'dark') {
        root.classList.add('dark');
    } else if (preferred === 'light') {
        root.classList.remove('dark');
    }

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const isDark = root.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    });
}

function initEditModal() {
    const modal = document.getElementById('edit-kisi-modal');
    if (!modal) return;

    const overlay = modal.querySelector('[data-edit-modal-overlay]');
    const closeButtons = modal.querySelectorAll('[data-edit-modal-close]');
    const form = modal.querySelector('form');
    const idField = modal.querySelector('input[name=\"id\"]');
    const adField = modal.querySelector('input[name=\"ad\"]');
    const soyadField = modal.querySelector('input[name=\"soyad\"]');
    const yasField = modal.querySelector('input[name=\"yas\"]');
    const emailField = modal.querySelector('input[name=\"email\"]');

    function openModal(button) {
        const action = button.dataset.action;
        form.action = action;

        adField.value = button.dataset.ad || '';
        soyadField.value = button.dataset.soyad || '';
        yasField.value = button.dataset.yas || '';
        emailField.value = button.dataset.email || '';
        idField.value = button.dataset.id || '';

        modal.classList.remove('hidden');
    }

    function closeModal() {
        modal.classList.add('hidden');
    }

    window.openEditKisiModal = openModal;
    window.closeEditKisiModal = closeModal;

    if (overlay) {
        overlay.addEventListener('click', closeModal);
    }

    closeButtons.forEach((btn) => btn.addEventListener('click', closeModal));
}

