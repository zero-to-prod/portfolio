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