const shareButtons = document.querySelectorAll('#share, #share-mobile');
const titleElement = document.getElementById('title');
const subtitleElement = document.getElementById('subtitle');
const currentUrl = window.location.href;

function shareContent() {
    if (navigator.share) {
        navigator.share({
            title: titleElement.innerText,
            text: subtitleElement.innerText,
            url: currentUrl,
        })
            .catch(console.error);
    }
}

shareButtons.forEach(button => button.addEventListener('click', shareContent));