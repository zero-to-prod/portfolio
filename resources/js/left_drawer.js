const toggleNavbarBtn = document.getElementById('toggle-navbar-btn');
const navbarWide = document.getElementById('left-nav-wide');
const navbarNarrow = document.getElementById('left-nav-narrow');
const content = document.getElementById('content');

// Retrieve the stored toggle state from local storage
const isNavbarWideOpen = JSON.parse(localStorage.getItem('isNavbarWideOpen'));

// Set the initial toggle state based on the stored value
const block = 'min-[1312px]:block';
const hidden = 'min-[1312px]:hidden';
const ml = 'min-[1312px]:ml-[238px]';
if (isNavbarWideOpen) {
    navbarWide.classList.add(block);
    navbarNarrow.classList.add(hidden);
    content.classList.add(ml);
} else {
    navbarWide.classList.remove(block);
    navbarNarrow.classList.remove(hidden);
    content.classList.remove(ml);
}

toggleNavbarBtn.addEventListener('click', () => {
    // Toggle the classes as before
    navbarWide.classList.toggle(block);
    navbarNarrow.classList.toggle(hidden);
    content.classList.toggle(ml);

    // Store the toggle state in local storage
    const isNavbarWideOpen = navbarWide.classList.contains(block);
    localStorage.setItem('isNavbarWideOpen', JSON.stringify(isNavbarWideOpen));
});