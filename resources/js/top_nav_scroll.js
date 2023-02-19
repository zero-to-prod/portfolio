/* This functionality applies styles on page load then removes them when scrolling. */

const e = document.querySelector('#nav');
e.classList.add('bg-sky-200');
let scrolling = true;

document.addEventListener('scroll', () => {
    const {scrollTop} = document.documentElement;

    if (scrollTop === 0) {
        e.classList.remove('bg-white', 'shadow');
        scrolling = true;
    } else if (scrolling) {
        e.classList.add('bg-white', 'shadow');
        scrolling = false;
    }
});
