import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

window.heroCarousel = (cars = []) => ({
    cars,
    active: 0,
    intervalId: null,
    touchStartX: 0,
    visibilityHandler: null,
    get currentCar() {
        return this.cars[this.active] ?? {};
    },
    init() {
        if (this.cars.length <= 1) {
            return;
        }

        this.startAutoplay();

        this.visibilityHandler = () => {
            if (document.hidden) {
                this.pauseAutoplay();
                return;
            }

            this.startAutoplay();
        };

        document.addEventListener('visibilitychange', this.visibilityHandler);
    },
    startAutoplay() {
        this.pauseAutoplay();

        if (this.cars.length <= 1) {
            return;
        }

        this.intervalId = window.setInterval(() => {
            this.active = (this.active + 1) % this.cars.length;
        }, 4500);
    },
    pauseAutoplay() {
        if (this.intervalId) {
            window.clearInterval(this.intervalId);
            this.intervalId = null;
        }
    },
    restartAutoplay() {
        this.startAutoplay();
    },
    next() {
        if (this.cars.length <= 1) {
            return;
        }

        this.active = (this.active + 1) % this.cars.length;
        this.restartAutoplay();
    },
    prev() {
        if (this.cars.length <= 1) {
            return;
        }

        this.active = (this.active - 1 + this.cars.length) % this.cars.length;
        this.restartAutoplay();
    },
    goTo(index) {
        if (this.cars.length <= 1 || index === this.active) {
            return;
        }

        this.active = index;
        this.restartAutoplay();
    },
    handleTouchStart(event) {
        this.touchStartX = event.changedTouches?.[0]?.clientX ?? 0;
    },
    handleTouchEnd(event) {
        const touchEndX = event.changedTouches?.[0]?.clientX ?? 0;
        const deltaX = touchEndX - this.touchStartX;

        if (Math.abs(deltaX) < 40) {
            return;
        }

        if (deltaX < 0) {
            this.next();
            return;
        }

        this.prev();
    },
});

Alpine.start();

const setupScrollAnimations = () => {
    const animatedElements = document.querySelectorAll('[data-aos]');

    document.documentElement.classList.add('aos-ready');

    if (!animatedElements.length || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        animatedElements.forEach((element) => {
            element.classList.add('aos-animate');
        });
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('aos-animate');
                observer.unobserve(entry.target);
            });
        },
        {
            threshold: 0.15,
            rootMargin: '0px 0px -5% 0px',
        }
    );

    animatedElements.forEach((element) => {
        const delay = Number.parseInt(element.dataset.aosDelay || '0', 10);

        if (!Number.isNaN(delay) && delay > 0) {
            element.style.transitionDelay = `${delay}ms`;
        }

        observer.observe(element);
    });
};

document.addEventListener('DOMContentLoaded', setupScrollAnimations);
