// Toasts
function createToast(text, type = 'info') {
    // Create the toast container if it doesn't already exist
    let toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
        document.body.appendChild(toastContainer);
    }

    // Create a new toast element
    const toastElement = document.createElement('div');
    toastElement.className = 'toast';
    toastElement.setAttribute('role', 'alert');
    toastElement.setAttribute('aria-live', 'assertive');
    toastElement.setAttribute('aria-atomic', 'true');

    icon = '';

    switch (type) {
        case 'success':
            icon = 'bi-check-circle-fill';
            break;
        case 'error':
            icon = 'bi-x-circle-fill';
            break;
        case 'info':
            icon = 'bi-info-circle-fill';
            break;
        default:
            break;
    }

    toastElement.innerHTML = `
        <div class="toast-header">
            <i class="bi ${icon} ${type} me-2"></i>
            <strong class="me-auto">DockerEats</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            ${text}
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