// Select form element
const button = document.getElementById('share')
const buttonMobile = document.getElementById('share-mobile')
const title = document.getElementById('title')
const subtitle = document.getElementById('subtitle')
const url = window.location.href

function share() {
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
}

button.addEventListener('click', share);
buttonMobile.addEventListener('click', share);
