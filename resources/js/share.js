// Select form element
const button = document.getElementById('share')
const title = document.getElementById('title')
const subtitle = document.getElementById('subtitle')
const url = window.url

// Attach the submit event handler
button.addEventListener('click', shareFiles)

// Share files on submit
async function shareFiles() {
    const userAgentData = await navigator.userAgentData.getHighEntropyValues(['platform', 'platformVersion']);
    const data = {
        title: title.innerText,
        text: subtitle.innerText,
        url: url,
    }

    if (userAgentData.platform === 'iOS' && parseFloat(userAgentData.platformVersion) < 14.7) {
        // Handle iOS versions that don't support the Web Share API
        // Redirect to a share page or display a share sheet overlay
    } else {
        await navigator.share(data);
    }
}