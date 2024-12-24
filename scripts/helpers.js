// Toasts
function createToast(text) {
    // Create the toast container if it doesn't already exist
    let toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
        document.body.appendChild(toastContainer);
    }

    // Create a new toast element
    const toastElement = document.createElement('div');
    toastElement.className = 'toast align-items-center';
    toastElement.setAttribute('role', 'alert');
    toastElement.setAttribute('aria-live', 'assertive');
    toastElement.setAttribute('aria-atomic', 'true');

    toastElement.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${text}
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;

    // Append the new toast to the container
    toastContainer.appendChild(toastElement);

    // Initialize and show the toast using Bootstrap's Toast class
    const toastBootstrap = new bootstrap.Toast(toastElement);
    toastBootstrap.show();

    // Remove the toast from the DOM after it hides
    toastElement.addEventListener('hidden.bs.toast', () => {
        toastElement.remove();
    });
}

