document.addEventListener('DOMContentLoaded', function () {
    // --- Elemen Modal Tambah User ---
    const openAddUserModalButton = document.getElementById('openAddUserModalButton');
    const closeAddUserModalButton = document.getElementById('closeAddUserModalButton');
    const cancelAddUserModalButton = document.getElementById('cancelAddUserModalButton');
    const addUserModal = document.getElementById('addUserModal');
    const addUserForm = document.getElementById('addUserForm');
    // const addNameInput = document.getElementById('add_name'); // Tidak perlu di-declare jika hanya untuk reset/validasi otomatis
    // const addEmailInput = document.getElementById('add_email');
    // const addPasswordInput = document.getElementById('add_password');
    // const addRoleSelect = document.getElementById('add_role');

    // --- Elemen Modal Edit User ---
    const editUserButtons = document.querySelectorAll('.edit-user-button');
    const closeEditUserModalButton = document.getElementById('closeEditUserModalButton');
    const cancelEditUserModalButton = document.getElementById('cancelEditUserModalButton');
    const editUserModal = document.getElementById('editUserModal');
    const editUserForm = document.getElementById('editUserForm');
    const editUserIdInput = document.getElementById('edit_user_id');
    const editNameInput = document.getElementById('edit_name');
    const editEmailInput = document.getElementById('edit_email');
    const editPasswordInput = document.getElementById('edit_password');
    const editRoleSelect = document.getElementById('edit_role');

    // --- Fungsi Buka/Tutup Modal Generik ---
    function openModal(modalElement) {
        modalElement.classList.remove('hidden');
        modalElement.classList.add('flex');
        const modalContent = modalElement.querySelector('.modal-fade-in');
        if (modalContent) {
            modalContent.classList.remove('modal-fade-out');
            modalContent.classList.add('modal-fade-in');
        }
    }

    function closeAnimationAndHideModal(modalElement) {
        const modalContent = modalElement.querySelector('.modal-fade-in');
        if (modalContent) {
            modalContent.classList.remove('modal-fade-in');
            modalContent.classList.add('modal-fade-out');
            setTimeout(() => {
                modalElement.classList.add('hidden');
                modalElement.classList.remove('flex');
                modalContent.classList.remove('modal-fade-out'); // Clean up animation class
                resetFormValidation(modalElement); // Reset validation errors
            }, 300); // Match animation duration
        } else {
            // Fallback if no specific content with animation class
            modalElement.classList.add('hidden');
            modalElement.classList.remove('flex');
        }
    }

    // Fungsi untuk mereset tampilan validasi form (digunakan untuk modal Add dan Edit)
    function resetFormValidation(modalElement) {
        const form = modalElement.querySelector('form');
        if (form) {
            const errorParagraphs = form.querySelectorAll('.text-red-500.italic');
            errorParagraphs.forEach(p => p.remove()); // Hapus semua pesan error

            const errorInputs = form.querySelectorAll('.border-red-500');
            errorInputs.forEach(input => input.classList.remove('border-red-500')); // Hapus border merah
        }
    }


    // --- Event Listeners untuk Modal Tambah User ---
    openAddUserModalButton.addEventListener('click', function () {
        addUserForm.reset(); // Reset form saat dibuka
        resetFormValidation(addUserModal); // Bersihkan validasi sebelumnya
        openModal(addUserModal);
    });
    closeAddUserModalButton.addEventListener('click', function () {
        closeAnimationAndHideModal(addUserModal);
    });
    cancelAddUserModalButton.addEventListener('click', function () {
        closeAnimationAndHideModal(addUserModal);
    });
    addUserModal.addEventListener('click', function (event) {
        if (event.target === addUserModal) {
            closeAnimationAndHideModal(addUserModal);
        }
    });

    // --- Event Listeners untuk Modal Edit User ---
    editUserButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.dataset.id;
            const userName = this.dataset.name;
            const userEmail = this.dataset.email;
            const userRole = this.dataset.role;
            const userUrl = this.dataset.url;

            // Isi form modal edit dengan data user
            editUserIdInput.value = userId;
            editNameInput.value = userName;
            editEmailInput.value = userEmail;
            editRoleSelect.value = userRole;
            editPasswordInput.value = ''; // Kosongkan password untuk keamanan (jangan mengisi password lama!)

            // Atur action form untuk update user
            // Ini akan bergantung pada route Laravel Anda, contoh: /admin/users/{id}
            editUserForm.action = userUrl; // Ganti dengan route yang benar jika perlu

            resetFormValidation(editUserModal); // Bersihkan validasi sebelumnya
            openModal(editUserModal);
        });
    });

    closeEditUserModalButton.addEventListener('click', function () {
        closeAnimationAndHideModal(editUserModal);
    });
    cancelEditUserModalButton.addEventListener('click', function () {
        closeAnimationAndHideModal(editUserModal);
    });
    editUserModal.addEventListener('click', function (event) {
        if (event.target === editUserModal) {
            closeAnimationAndHideModal(editUserModal);
        }
    });

    // --- Global: Tutup modal dengan Escape key ---
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            if (!addUserModal.classList.contains('hidden')) {
                closeAnimationAndHideModal(addUserModal);
            }
            if (!editUserModal.classList.contains('hidden')) {
                closeAnimationAndHideModal(editUserModal);
            }
        }
    });

    // --- Penting: Penanganan Error Validasi dari Backend ---
    // Di Laravel, setelah form submission yang gagal (misal, validasi gagal),
    // Laravel akan mengarahkan kembali ke halaman sebelumnya dengan $errors
    // dan old() input.
    // Kita perlu memastikan modal tetap terbuka jika ada error setelah submit.
    const allErrorInputs = document.querySelectorAll('input.border-red-500, select.border-red-500');
    if (allErrorInputs.length > 0) {
        // Cek apakah error berasal dari form 'Add User'
        if (document.getElementById('add_name').classList.contains('border-red-500') ||
            document.getElementById('add_email').classList.contains('border-red-500') ||
            document.getElementById('add_password').classList.contains('border-red-500') ||
            document.getElementById('add_role').classList.contains('border-red-500')) {
            openModal(addUserModal);
        }
        // Cek apakah error berasal dari form 'Edit User'
        else if (document.getElementById('edit_name').classList.contains('border-red-500') ||
            document.getElementById('edit_email').classList.contains('border-red-500') ||
            document.getElementById('edit_password').classList.contains('border-red-500') ||
            document.getElementById('edit_role').classList.contains('border-red-500')) {
            // Untuk modal edit, kita perlu mengisi ulang data yang sedang diedit
            // Ini bisa dilakukan jika Laravel mengembalikan ID user yang gagal divalidasi,
            // atau jika Anda menyimpan ID di suatu tempat (misal, hidden input).
            // Cara paling robust adalah Laravel mengisi kembali 'old' data di form edit.
            // Jika ada error di form edit, modal edit akan dibuka. Data lama akan terisi
            // secara otomatis oleh Laravel's `old()` helper di Blade.
            openModal(editUserModal);
        }
    }
});