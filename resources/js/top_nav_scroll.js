/* This functionality applies css classes on page load then removes them when scrolling. */

const e = document.querySelector('#nav');
/* Used for performance concerns */
let scrolling = true;
const classList = ['shadow', 'bg-white']

function mutateClassList() {
    const {scrollTop} = document.documentElement;

    if (scrollTop === 0) {
        e.classList.remove(...classList);
        scrolling = true;
        return;
    }

    if (scrolling) {
        e.classList.add(...classList);
        scrolling = false;
    }
}

document.addEventListener('scroll', mutateClassList);

/* This applies the correct classes if the page is not at the top when loaded */
document.addEventListener('DOMContentLoaded', mutateClassList);

