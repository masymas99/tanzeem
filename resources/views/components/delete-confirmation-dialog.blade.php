<!-- Delete Confirmation Dialog Component -->
<div id="delete-confirmation-dialog" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-96 text-center">
        <div class="mb-4">
            <i class="fas fa-exclamation-triangle text-4xl text-yellow-500 mb-4"></i>
            <h3 class="text-xl font-bold mb-2">تأكيد الحذف</h3>
            <p class="text-gray-600">هل أنت متأكد من حذف هذا العنصر؟</p>
        </div>
        <div class="flex justify-center gap-4">
            <button id="confirm-delete" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                حذف
            </button>
            <button id="cancel-delete" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition-colors">
                إلغاء
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteDialog = document.getElementById('delete-confirmation-dialog');
        const confirmDelete = document.getElementById('confirm-delete');
        const cancelDelete = document.getElementById('cancel-delete');
        let currentDeleteUrl = null;

        // Show dialog when delete buttons are clicked
        document.querySelectorAll('[data-delete-url]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                currentDeleteUrl = this.dataset.deleteUrl;
                deleteDialog.classList.remove('hidden');
            });
        });

        // Confirm delete
        confirmDelete.addEventListener('click', function() {
            if (currentDeleteUrl) {
                fetch(currentDeleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Close dialog
                        deleteDialog.classList.add('hidden');
                        // Reload the page after successful deletion
                        window.location.reload();
                    } else {
                        throw new Error('Failed to delete');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });

        // Cancel delete
        cancelDelete.addEventListener('click', function() {
            deleteDialog.classList.add('hidden');
            currentDeleteUrl = null;
        });

        // Close dialog when clicking outside
        deleteDialog.addEventListener('click', function(e) {
            if (e.target === this) {
                deleteDialog.classList.add('hidden');
                currentDeleteUrl = null;
            }
        });
    });
</script>
