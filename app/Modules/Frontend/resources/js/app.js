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

const themeSwitchCallback = () => {

    const selectedTheme = localStorage.getItem('theme') || 'dark';
    const theme = 'theme-' + selectedTheme;

    // Rove any class that starts with 'theme-' from the body
    document.body.className.split(' ').forEach((className) => {
        if (className.startsWith('theme-')) {
            document.body.classList.remove(className);
        }
    });

    document.body.classList.add(theme);
}
document.addEventListener('DOMContentLoaded', themeSwitchCallback);
document.addEventListener("livewire:navigated", themeSwitchCallback);
document.addEventListener('theme-updated', themeSwitchCallback);

document.addEventListener("DOMContentLoaded", calculateLineNumbers);
window.addEventListener("resize", calculateLineNumbers);
document.addEventListener("livewire:navigated", calculateLineNumbers);
