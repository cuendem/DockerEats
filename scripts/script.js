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