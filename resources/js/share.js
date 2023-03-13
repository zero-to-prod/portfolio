// Select form element
const button = document.getElementById('share')
const title = document.getElementById('title')
const subtitle = document.getElementById('subtitle')
const url = window.url

if(!navigator.share) {
    button.classList.toggle('hidden')
}

button.addEventListener('click', event => {
    if (navigator.share) {
        navigator.share({
            title: title.innerText,
            text: subtitle.innerText,
            url: url,
        }).then(() => {
            console.log('Thanks for sharing!');
        })
            .catch(console.error);
    }
});