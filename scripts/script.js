// Hide header when scrolling

let lastScrollPosition = 0;
const header = document.getElementById('header');

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

const buildMain = document.getElementById('build-main');
const buildMainOV = document.getElementById('build-main-overlay');

// Open overlay when clicked
buildMain.addEventListener('click', () => {
    openOverlay(buildMainOV);
});

// Exit when clicked outside
buildMainOV.addEventListener('click', (e) => {
    if (e.target === e.currentTarget) {
        // Only trigger if clicked the overlay itself (not the div inside which has all the stuff)
        openOverlay(buildMainOV);
    }
})