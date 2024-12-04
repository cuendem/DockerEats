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
    });
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
    const pickupInput = document.getElementById('pickup-selected'); // Hidden input for pickup selection
    const deliveryFee = document.getElementById('delivery-fee');

    // Update the 'selected' classes
    if (isDelivery) {
        deliveryElement.classList.add('selected');
        pickupElement.classList.remove('selected');
    } else {
        deliveryElement.classList.remove('selected');
        pickupElement.classList.add('selected');
    }

    // Update the hidden input values
    document.getElementById('delivery-selected').value = isDelivery ? 'true' : 'false';
    pickupInput.value = isDelivery ? 'false' : 'true'; // Update the pickup-selected input value

    // Update button states
    deliveryButton.innerHTML = isDelivery ? 'Selected' : 'Select';
    deliveryButton.classList.toggle('btn-normal', !isDelivery);
    deliveryButton.classList.toggle('btn-selected', isDelivery);

    pickupButton.innerHTML = isDelivery ? 'Select' : 'Selected';
    pickupButton.classList.toggle('btn-normal', isDelivery);
    pickupButton.classList.toggle('btn-selected', !isDelivery);

    deliveryFee.classList.toggle('hidden', !isDelivery);
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
