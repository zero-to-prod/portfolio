const handleKeyDown = (event) => {
    const {key, target} = event;
    const searchInput = document.getElementById("search");

    if (key === "/" && target.tagName !== "INPUT") {
        searchInput.focus();
        event.preventDefault();
    } else if (key === "Escape" && target === searchInput) {
        searchInput.blur();
        event.preventDefault();
    }
};

document.addEventListener("keydown", handleKeyDown);

const navbar = document.getElementById('masthead');
const bottomNav = document.getElementById('bottom-nav');
let previousScrollPosition = 0;

function handleScroll() {
    const currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop;
    if(currentScrollPosition < 64) return;
    if (!navbar || !bottomNav) return;

    if (currentScrollPosition >= previousScrollPosition) {
        addScrollClasses();
    } else {
        removeScrollClasses();
    }

    previousScrollPosition = currentScrollPosition;
}

const classes = ['2col:m-0', '-my-[64px]'];

function addScrollClasses() {
    navbar.classList.add(...classes);
    bottomNav.classList.add(...classes);
}

function removeScrollClasses() {
    navbar.classList.remove(...classes);
    bottomNav.classList.remove(...classes);
}

window.addEventListener('scroll', handleScroll);