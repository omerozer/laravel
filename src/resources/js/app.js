import './bootstrap';

// Init immediately if DOM hazır, yoksa DOMContentLoaded bekle
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initThemeToggle();
        initEditModal();
        initSwitches();
        initNotifications();
    });
} else {
    initThemeToggle();
    initEditModal();
    initSwitches();
    initNotifications();
}

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
        if (action) form.setAttribute('action', action);

        adField.value = button.dataset.ad || '';
        soyadField.value = button.dataset.soyad || '';
        yasField.value = button.dataset.yas || '';
        emailField.value = button.dataset.email || '';
        idField.value = button.dataset.id || '';

        const aktifInput = form.querySelector('[data-aktif-input]');
        if (aktifInput) {
            aktifInput.value = button.dataset.aktif === '0' ? '0' : '1';
            const switchBtn = form.querySelector('[data-switch]');
            if (switchBtn) switchBtn.dispatchEvent(new CustomEvent('aktif-sync'));
        }

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

function initSwitches() {
    document.querySelectorAll('[data-switch]').forEach((el) => {
        const knob = el.querySelector('[data-switch-knob]');
        if (!knob) return;

        const form = el.closest('form');
        const aktifInput = form ? form.querySelector('[data-aktif-input]') : null;
        let isOn = aktifInput ? aktifInput.value === '1' : true;

        function render() {
            el.classList.toggle('bg-green-500', isOn);
            el.classList.toggle('bg-red-500', !isOn);
            knob.classList.toggle('translate-x-5', isOn);
            knob.classList.toggle('translate-x-0', !isOn);
            if (aktifInput) aktifInput.value = isOn ? '1' : '0';
        }

        el.addEventListener('aktif-sync', () => {
            if (aktifInput) {
                isOn = aktifInput.value === '1';
                render();
            }
        });

        el.addEventListener('click', () => {
            isOn = !isOn;
            render();
        });

        render();
    });
}

const NOTIFICATION_PRESETS = {
    success: {
        title: 'Kayıt başarılı',
        body: 'Değişiklikler kaydedildi.',
        icon: '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />',
        border: 'border-green-200 dark:border-green-500/30',
        bg: 'bg-green-50 dark:bg-green-500/10',
        iconBg: 'bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400',
        titleCl: 'text-green-800 dark:text-green-300',
        bodyCl: 'text-green-700 dark:text-green-400',
    },
    danger: {
        title: 'Hata oluştu',
        body: 'Lütfen formu kontrol edip tekrar deneyin.',
        icon: '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />',
        border: 'border-red-200 dark:border-red-500/30',
        bg: 'bg-red-50 dark:bg-red-500/10',
        iconBg: 'bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400',
        titleCl: 'text-red-800 dark:text-red-300',
        bodyCl: 'text-red-700 dark:text-red-400',
    },
    warning: {
        title: 'Uyarı',
        body: 'Bu işlem geri alınamaz.',
        icon: '<path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />',
        border: 'border-accent-500/30 dark:border-accent-500/30',
        bg: 'bg-accent-500/10 dark:bg-accent-500/10',
        iconBg: 'bg-accent-500/20 text-accent-600 dark:text-accent-400',
        titleCl: 'text-accent-800 dark:text-accent-300',
        bodyCl: 'text-accent-700 dark:text-accent-400',
    },
    info: {
        title: 'Bilgi',
        body: 'Yeni özellikler hakkında bilgi almak için dokümantasyona bakın.',
        icon: '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 12H9.5a.75.75 0 000 1.5h.247a1.75 1.75 0 001.248-.859l.459-2.066a.25.25 0 00-.244-.304H9.5A.75.75 0 009 9z" clip-rule="evenodd" />',
        border: 'border-blue-200 dark:border-blue-500/30',
        bg: 'bg-blue-50 dark:bg-blue-500/10',
        iconBg: 'bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400',
        titleCl: 'text-blue-800 dark:text-blue-300',
        bodyCl: 'text-blue-700 dark:text-blue-400',
    },
};

function showToast(type, title, body) {
    const preset = NOTIFICATION_PRESETS[type] || NOTIFICATION_PRESETS.info;
    const t = title ?? preset.title;
    const b = body ?? preset.body;

    const container = document.getElementById('notification-toast-container');
    if (!container) return;

    const el = document.createElement('div');
    el.className = `notification-toast pointer-events-auto flex items-start gap-3 rounded-xl border shadow-lg p-4 transform transition-all duration-300 ease-out ${preset.border} ${preset.bg} translate-x-full opacity-0`;
    el.setAttribute('role', 'alert');
    el.innerHTML = `
        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full ${preset.iconBg}">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">${preset.icon}</svg>
        </span>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold ${preset.titleCl}">${escapeHtml(t)}</p>
            <p class="mt-0.5 text-sm ${preset.bodyCl}">${escapeHtml(b)}</p>
        </div>
        <button type="button" class="notification-toast-close shrink-0 rounded-lg p-1 text-gray-400 hover:bg-black/5 hover:text-gray-600 dark:hover:bg-white/10 dark:hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-500/50 cursor-pointer" aria-label="Kapat">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
        </button>
    `;

    container.appendChild(el);

    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            el.classList.remove('translate-x-full', 'opacity-0');
            el.classList.add('translate-x-0', 'opacity-100');
        });
    });

    const close = () => {
        el.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => el.remove(), 300);
    };

    el.querySelector('.notification-toast-close')?.addEventListener('click', close);

    let autoCloseTimer = setTimeout(close, 5000);
    el.addEventListener('mouseenter', () => {
        clearTimeout(autoCloseTimer);
    });
    el.addEventListener('mouseleave', () => {
        autoCloseTimer = setTimeout(close, 5000);
    });
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function initNotifications() {
    document.querySelectorAll('[data-notify]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const type = btn.getAttribute('data-notify') || 'info';
            showToast(type);
        });
    });
}

window.showToast = showToast;

