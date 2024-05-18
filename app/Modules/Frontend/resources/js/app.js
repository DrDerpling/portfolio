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
        const lineSpan = document.createElement('div');
        lineSpan.textContent = `${i}`;
        lineSpan.classList.add('text-right');
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

document.addEventListener('alpine:init', () => {
    Alpine.data('slider', () => ({
        currentIndex: 0,
        totalSlides: 0,
        firstChild: null,
        container: null,
        visibleSlides: 0,

        init() {
            this.container = this.$refs.container;
            this.totalSlides = this.container.querySelectorAll('div.snap-start').length;
            this.firstChild = this.container.querySelector('div.snap-start');
            this.visibleSlides = this.countVisibleSlides();
            this.updateCarousel();

            window.addEventListener('resize', () => {
                this.visibleSlides = this.countVisibleSlides();
                this.updateCarousel();
            });
        },

        updateCarousel() {
            if (!this.firstChild) {
                console.warn('No slides found, so the slider cannot be updated.');
                return;
            }

            const index = this.currentIndex  * this.visibleSlides;
            const showedSlides = (this.currentIndex + 1) * this.visibleSlides;
            this.container.scrollLeft = index * this.firstChild.offsetWidth;

            if (showedSlides >= this.totalSlides) {
                this.currentIndex = index;
            }
        },

        countVisibleSlides() {
            const slides = this.container.querySelectorAll('div.snap-start');
            let visibleCount = 0;
            const containerRect = this.container.getBoundingClientRect();

            slides.forEach(slide => {
                let rect = slide.getBoundingClientRect();
                if (rect.left >= containerRect.left && rect.right <= containerRect.right) {
                    visibleCount++;
                }
            });

            return visibleCount;
        },

        next() {
            if (this.currentIndex < this.totalSlides - 1) {
                this.currentIndex++;
                this.updateCarousel();
            } else {
                // Optionally loop back to the first slide
                this.currentIndex = 0;
                this.updateCarousel();
            }
        },

        prev() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
                this.updateCarousel();
            } else {
                // Optionally loop back to the last slide
                this.currentIndex = this.totalSlides - 1;
                this.updateCarousel();
            }
        }
    }));
});
