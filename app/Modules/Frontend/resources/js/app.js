import './bootstrap.js';

const calculateLineNumbers = () => {
    const lineNumbersDivs = document.querySelectorAll('.line-numbers');

    lineNumbersDivs.forEach(calculateLineNumbersCallback)
};

const calculateLineNumbersCallback = (element) => {
    element.innerHTML = '';

    const offset = 100;
    const containerHeight = element.parentElement.clientHeight + offset - parseInt(window.getComputedStyle(element.parentElement).paddingTop) - parseInt(window.getComputedStyle(element.parentElement).paddingBottom) - parseInt(element.offsetTop);
    const lineHeight = parseInt(element.getAttribute('data-line-height'), 10);

    if (isNaN(lineHeight) || lineHeight <= 0) {
        console.error('Invalid line height.');
        return;
    }

    // Calculate how many lines fit within the container
    const numberOfLines = Math.floor(containerHeight / lineHeight);
    for (let i = 1; i <= numberOfLines; i++) {
        const lineSpan = document.createElement('span');
        lineSpan.textContent = `${i}`;
        element.appendChild(lineSpan);
    }
}

document.addEventListener("DOMContentLoaded", calculateLineNumbers);
window.addEventListener("resize", calculateLineNumbers);
document.addEventListener("livewire:navigated", calculateLineNumbers);
