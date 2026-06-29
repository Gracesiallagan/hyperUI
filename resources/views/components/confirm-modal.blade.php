<div class="gt-modal" id="gtConfirmModal" aria-hidden="true">
    <div class="gt-modal-backdrop" data-modal-cancel></div>
    <div class="gt-modal-card" role="dialog" aria-modal="true" aria-labelledby="gtModalTitle">
        <div class="gt-modal-icon">!</div>
        <h2 id="gtModalTitle">Konfirmasi</h2>
        <p id="gtModalMessage">Apakah Anda yakin ingin melanjutkan?</p>
        <div class="gt-modal-actions">
            <button type="button" class="btn btn-ghost" data-modal-cancel>Batal</button>
            <button type="button" class="btn btn-primary" id="gtModalConfirm">Konfirmasi</button>
        </div>
    </div>
</div>

<script>
(function () {
    const modal = document.getElementById('gtConfirmModal');
    if (!modal) return;

    const title = document.getElementById('gtModalTitle');
    const message = document.getElementById('gtModalMessage');
    const confirmBtn = document.getElementById('gtModalConfirm');
    let pendingForm = null;

    function openModal(form) {
        pendingForm = form;
        title.textContent = form.dataset.confirmTitle || 'Konfirmasi Aksi';
        message.textContent = form.dataset.confirmMessage || 'Apakah Anda yakin ingin melanjutkan?';
        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
        confirmBtn.focus();
    }

    function closeModal() {
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        pendingForm = null;
    }

    document.addEventListener('submit', function (event) {
        const form = event.target;
        if (!form.matches('[data-confirm-submit]') || form.dataset.confirmed === 'true') return;

        event.preventDefault();
        openModal(form);
    });

    confirmBtn.addEventListener('click', function () {
        if (!pendingForm) return;
        pendingForm.dataset.confirmed = 'true';
        pendingForm.submit();
    });

    modal.querySelectorAll('[data-modal-cancel]').forEach(btn => btn.addEventListener('click', closeModal));
    document.addEventListener('keydown', event => { if (event.key === 'Escape') closeModal(); });
})();
</script>
