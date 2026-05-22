import './bootstrap';

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

document.documentElement.classList.add('js-ready');

if (!prefersReducedMotion) {
    const revealItems = document.querySelectorAll('[data-reveal]');

    revealItems.forEach((item, index) => {
        item.classList.add('reveal-item');
        if (!item.style.getPropertyValue('--reveal-delay')) {
            const stagger = item.getAttribute('data-reveal-stagger') === 'true';
            item.style.setProperty('--reveal-delay', stagger ? `${Math.min(index * 80, 320)}ms` : '0ms');
        }
    });

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            root: null,
            rootMargin: '0px 0px -10% 0px',
            threshold: 0.16,
        }
    );

    revealItems.forEach((item) => observer.observe(item));
}
