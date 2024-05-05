import './bootstrap.js';

// Select all elements that have the attribute 'data-parent-menu-item'
const menuItems = document.querySelectorAll('[data-parent-menu-item]');

const menuToggleCallback = (event) => {
    const menuItems = event.target.parentElement.nextElementSibling.querySelectorAll('[data-menu-item]');
    const chevrons = event.target.parentElement.querySelectorAll('.chevron');

    // Toggle the class 'hidden' on
    // the child anchor elements
    menuItems.forEach(item => {
        item.classList.toggle('hidden');
    })

    // Toggle the class 'hidden' on the chevron elements
    chevrons.forEach(chevron => {
        chevron.classList.toggle('hidden');
    });
};

const calculateLineNumbers = () => {
    const lineNumbersDiv = document.querySelector('.line-numbers');
    lineNumbersDiv.innerHTML = '';

    const screenHeight = window.innerHeight;
    const lineHeight = 25;
    const numberOfLines = Math.floor(screenHeight / lineHeight);

    for (let i = 1; i <= numberOfLines; i++) {
        const lineSpan = document.createElement('span');
        lineSpan.textContent = `${i}`;
        lineNumbersDiv.appendChild(lineSpan);
    }
};

menuItems.forEach(item => {
    item.addEventListener('click', menuToggleCallback);
});

document.addEventListener("DOMContentLoaded", calculateLineNumbers);
window.addEventListener("resize", calculateLineNumbers);

