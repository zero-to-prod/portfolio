// Select form element
const button = document.getElementById('share')
const title = document.getElementById('title')
const subtitle = document.getElementById('subtitle')
const url = window.url

// Attach the submit event handler
button.addEventListener('click', shareFiles)

// Share files on submit
async function shareFiles(event) {
    // Prevent form default behavior
    event.preventDefault()

    // Check if the device is able to share these files then open share dialog
    if (navigator.canShare) {
        try {
            await navigator.share({
                title: title.innerText,
                text: subtitle.innerText,
                url: url,
            })
        } catch (error) {
            console.log('Sharing failed', error)
        }
    } else {
        console.log('This device does not support sharing files.')
    }
}