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

// Tooltips
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

// Hide header when scrolling
let lastScrollPosition = 0;
const header = document.getElementById('header');

if (header) {
    window.addEventListener('scroll', () => {
        const currentScrollPosition = window.scrollY;
    
        if (currentScrollPosition > lastScrollPosition) {
            // Scrolling down, hide the header
            header.classList.add('hidden');
        } else {
            // Scrolling up, show the header
            header.classList.remove('hidden');
        }
    
        lastScrollPosition = currentScrollPosition;
    }, { passive: true });
}

// Preview PFP when changing it
function previewPfp() {
    // Get the file input element
    var fileInput = event.target;

    // Get the selected file
    var file = fileInput.files[0];

    // Get the image element
    var imgElement = document.getElementById('preview-image');

    // Create a FileReader
    var reader = new FileReader();

    // Set up the FileReader to update the image source when the file is read
    reader.onload = function (e) {
        imgElement.src = e.target.result;
    };

    // Read the selected file as a data URL
    reader.readAsDataURL(file);
}

// POPUP OVERLAYS FOR THE BUILD PAGE
function openOverlay(overlay) {
    overlay.classList.toggle('hidden');
}

const types = ['main', 'branch', 'drink', 'dessert'];

types.forEach(type => {
    const buildButton = document.getElementById(`build-${type}`);
    const buildOverlay = document.getElementById(`build-${type}-overlay`);

    // Open overlay when clicked
    if (buildButton && buildOverlay) {
        buildButton.addEventListener('click', () => {
            openOverlay(buildOverlay);
        });
    
        // Exit when clicked outside
        buildOverlay.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                // Only trigger if clicked the overlay itself (not the div inside which has all the stuff)
                openOverlay(buildOverlay);
            }
        });
    }
});

// Search function in the popup overlays
document.querySelectorAll('input[name="dishname"]').forEach(input => {
    // Add to all 4 inputs
    input.addEventListener('input', (event) => {
        // When being typed
        const searchValue = event.target.value.toLowerCase();
        const overlay = event.target.closest('.overlay');
        const categories = overlay.querySelectorAll('.category-products'); // Select all product containers

        categories.forEach(category => {
            const products = category.querySelectorAll('.card.product');
            let hasVisibleProducts = false;

            products.forEach(product => {
                const productName = product.querySelector('.card-title').textContent.toLowerCase();
                if (productName.includes(searchValue)) {
                    product.style.display = ''; // Show matching product
                    hasVisibleProducts = true; // At least one product is visible in this category
                } else {
                    product.style.display = 'none'; // Hide non-matching product
                }
            });

            // Toggle visibility of the category based on product visibility
            const categoryHr = category.previousElementSibling; // The <hr>
            const categoryHeading = categoryHr.previousElementSibling; // The <h5>
            if (hasVisibleProducts) {
                category.style.display = ''; // Show category
                category.style.padding = '';
                category.style.margin = '';
                category.classList.add('p-1');

                categoryHr.style.display = ''; // Show hr
                categoryHeading.style.display = ''; // Show heading
            } else {
                category.style.display = 'none'; // Hide category
                category.style.padding = '0px';
                category.classList.remove('p-1');
                category.style.margin = '0px';

                categoryHr.style.display = 'none'; // Hide hr
                categoryHeading.style.display = 'none'; // Hide heading
            }
        });
    });
});

// Delivery type selection in cart
// Helper function to toggle the selected state
function toggleSelection(isDelivery) {
    const deliveryElement = document.getElementById('home-delivery');
    const pickupElement = document.getElementById('pick-up');
    const deliveryButton = document.getElementById('select-delivery');
    const pickupButton = document.getElementById('select-pickup');
    const deliveryInput = document.getElementById('delivery-selected'); // Hidden input for delivery selection
    const pickupInput = document.getElementById('pickup-selected'); // Hidden input for pickup selection
    const deliveryFee = document.getElementById('delivery-fee');
    const totalPrice = document.getElementById('total-price');

    // Fields to make required for delivery
    const addressField = document.getElementById('address');
    const floorField = document.getElementById('floor');
    const townField = document.getElementById('town');
    const cityField = document.getElementById('city');
    const postalcodeField = document.getElementById('postalcode');

    if ((isDelivery && deliveryInput.value !== 'true') || (!isDelivery && pickupInput.value !== 'true')) {
        totalPrice.innerHTML = Math.round((parseFloat(totalPrice.innerHTML) + (isDelivery ? 2.99 : -2.99)) * 100) / 100 + " €";
    }

    // Update the hidden input values
    deliveryInput.value = isDelivery ? 'true' : 'false';
    pickupInput.value = isDelivery ? 'false' : 'true';

    // Update containers
    deliveryElement.classList.toggle('selected', isDelivery);
    pickupElement.classList.toggle('selected', !isDelivery);

    // Update button states
    deliveryButton.innerHTML = isDelivery ? 'Selected' : 'Select';
    deliveryButton.classList.toggle('btn-normal', !isDelivery);
    deliveryButton.classList.toggle('btn-selected', isDelivery);

    pickupButton.innerHTML = isDelivery ? 'Select' : 'Selected';
    pickupButton.classList.toggle('btn-normal', isDelivery);
    pickupButton.classList.toggle('btn-selected', !isDelivery);

    deliveryFee.classList.toggle('hidden', !isDelivery);

    // Toggle required attribute for delivery fields
    [addressField, floorField, townField, cityField, postalcodeField].forEach((field) => {
        if (isDelivery) {
            field.setAttribute('required', 'required');
        } else {
            field.removeAttribute('required');
        }
    });
}

// Event listeners for delivery and pickup selection
if (document.getElementById('select-delivery') && document.getElementById('select-pickup')) {
    document.getElementById('select-delivery').addEventListener('click', (e) => {
        e.preventDefault();
        toggleSelection(true); // Delivery selected
    });

    document.getElementById('select-pickup').addEventListener('click', (e) => {
        e.preventDefault();
        toggleSelection(false); // Pickup selected
    });
}