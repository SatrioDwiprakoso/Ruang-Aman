import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

Alpine.plugin(focus);

Alpine.data('multiStepWizard', () => ({
    step: 1,
    maxStep: 4,
    categoryId: '',
    title: '',
    chronology: '',
    isAnonymous: false,
    evidences: [],
    errors: {},

    nextStep() {
        if (this.validateStep()) {
            if (this.step < this.maxStep) this.step++;
        }
    },
    prevStep() {
        if (this.step > 1) this.step--;
    },
    validateStep() {
        this.errors = {};
        if (this.step === 1 && !this.categoryId) {
            this.errors.category = 'Pilih salah satu kategori pengaduan.';
            return false;
        }
        if (this.step === 2) {
            if (!this.title.trim()) { this.errors.title = 'Judul pengaduan wajib diisi.'; return false; }
            if (this.title.trim().length < 10) { this.errors.title = 'Judul minimal 10 karakter.'; return false; }
            if (!this.chronology.trim()) { this.errors.chronology = 'Kronologi kejadian wajib diisi.'; return false; }
            if (this.chronology.trim().length < 30) { this.errors.chronology = 'Kronologi minimal 30 karakter.'; return false; }
        }
        return true;
    },
    get progressPercent() {
        return (this.step / this.maxStep) * 100;
    }
}));

Alpine.data('mobileMenu', () => ({
    open: false,
    toggle() { this.open = !this.open; },
    close() { this.open = false; }
}));

Alpine.data('adminSidebar', () => ({
    open: false,
    activeMenu: 'dashboard',
    toggle() { this.open = !this.open; },
    close() { this.open = false; }
}));

Alpine.data('filterTabs', () => ({
    activeFilter: 'Semua',
    setFilter(filter) { this.activeFilter = filter; }
}));

Alpine.data('toast', () => ({
    show: false,
    message: '',
    type: 'success',
    display(msg, type = 'success') {
        this.message = msg;
        this.type = type;
        this.show = true;
        setTimeout(() => { this.show = false; }, 4000);
    }
}));

Alpine.start();

window.Alpine = Alpine;