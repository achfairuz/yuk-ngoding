const clickBubbleColors = [
    'var(--yn-primary)',
    'var(--yn-secondary)',
    'rgba(244, 114, 182, 0.9)',
];

const clickBubbleArea = document.querySelector('.hero-section');
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

clickBubbleArea?.addEventListener('pointerdown', (event) => {
    if (event.button !== 0 || prefersReducedMotion) {
        return;
    }

    const bubbleCount = 7 + Math.floor(Math.random() * 5);

    for (let index = 0; index < bubbleCount; index += 1) {
        const bubble = document.createElement('span');
        const size = Math.round(8 + Math.random() * 16);
        const angle = (Math.PI * 2 * index) / bubbleCount;
        const distance = 34 + Math.random() * 44;
        const x = Math.cos(angle) * distance;
        const y = Math.sin(angle) * distance - 28;

        bubble.className = 'click-bubble';
        bubble.style.left = `${event.clientX}px`;
        bubble.style.top = `${event.clientY}px`;
        bubble.style.width = `${size}px`;
        bubble.style.height = `${size}px`;
        bubble.style.setProperty('--bubble-x', `${x}px`);
        bubble.style.setProperty('--bubble-y', `${y}px`);
        bubble.style.setProperty('--bubble-color', clickBubbleColors[index % clickBubbleColors.length]);
        bubble.style.animationDelay = `${index * 18}ms`;

        document.body.appendChild(bubble);
        bubble.addEventListener('animationend', () => bubble.remove(), { once: true });
    }
});

const createScrollTimeline = (gsap, trigger, start = 'top 72%') =>
    gsap.timeline({
        defaults: {
            ease: 'power3.out',
            duration: 0.75,
        },
        scrollTrigger: window.ScrollTrigger
            ? {
                  trigger,
                  start,
                  once: true,
              }
            : undefined,
    });

const initHeroAnimation = (gsap) => {
    const section = document.querySelector('[data-gsap-hero-section]');

    if (!section) {
        return;
    }

    const copyItems = gsap.utils.toArray('[data-gsap-hero-copy] > *', section);
    const codeWindow = section.querySelector('[data-gsap-hero-code]');
    const metrics = gsap.utils.toArray('[data-gsap-hero-metric]', section);

    gsap.timeline({
        defaults: {
            ease: 'power3.out',
            duration: 0.75,
        },
    })
        .from(copyItems, {
            autoAlpha: 0,
            y: 30,
            stagger: 0.08,
        })
        .from(
            codeWindow,
            {
                autoAlpha: 0,
                x: 44,
                rotate: -1.2,
            },
            '-=0.45',
        )
        .from(
            metrics,
            {
                autoAlpha: 0,
                y: 18,
                stagger: 0.08,
            },
            '-=0.35',
        );
};

const initFeatureSectionAnimation = (gsap) => {
    const section = document.querySelector('[data-gsap-feature-section]');

    if (!section) {
        return;
    }

    createScrollTimeline(gsap, section)
        .from(section.querySelector('[data-gsap-feature-heading]'), {
            autoAlpha: 0,
            y: 34,
        })
        .from(
            gsap.utils.toArray('[data-gsap-feature-card]', section),
            {
                autoAlpha: 0,
                y: 42,
                rotate: -0.8,
                stagger: 0.12,
            },
            '-=0.38',
        );
};

const initPathSectionAnimation = (gsap) => {
    const section = document.querySelector('[data-gsap-path-section]');

    if (!section) {
        return;
    }

    const heading = section.querySelector('[data-gsap-path-heading]');
    const line = section.querySelector('[data-gsap-path-line]');
    const items = gsap.utils.toArray('[data-gsap-path-item]', section);

    createScrollTimeline(gsap, section)
        .from(heading, {
            autoAlpha: 0,
            y: 32,
        })
        .from(
            line,
            {
                scaleY: 0,
                duration: 1,
                ease: 'power2.inOut',
            },
            '-=0.35',
        )
        .from(
            items,
            {
                autoAlpha: 0,
                x: 28,
                y: 18,
                stagger: 0.14,
            },
            '-=0.65',
        );

    items.forEach((item) => {
        item.addEventListener('mouseenter', () => {
            gsap.to(item, {
                y: -12,
                scale: 1.015,
                duration: 0.28,
                ease: 'power2.out',
            });
        });

        item.addEventListener('mouseleave', () => {
            gsap.to(item, {
                y: 0,
                scale: 1,
                duration: 0.28,
                ease: 'power2.out',
            });
        });
    });
};

const initContactSectionAnimation = (gsap) => {
    const section = document.querySelector('[data-gsap-contact-section]');

    if (!section) {
        return;
    }

    createScrollTimeline(gsap, section, 'top 76%')
        .from(section.querySelector('[data-gsap-contact-copy]'), {
            autoAlpha: 0,
            x: -36,
        })
        .from(
            gsap.utils.toArray('[data-gsap-contact-info]', section),
            {
                autoAlpha: 0,
                y: 22,
                stagger: 0.1,
            },
            '-=0.35',
        )
        .from(
            section.querySelector('[data-gsap-contact-form]'),
            {
                autoAlpha: 0,
                x: 42,
                rotate: 0.8,
            },
            '-=0.62',
        )
        .from(
            gsap.utils.toArray('[data-gsap-contact-field]', section),
            {
                autoAlpha: 0,
                y: 18,
                stagger: 0.07,
                duration: 0.5,
            },
            '-=0.35',
        );
};

const initHomeAnimations = () => {
    const gsap = window.gsap;

    if (!gsap || prefersReducedMotion) {
        return;
    }

    if (window.ScrollTrigger) {
        gsap.registerPlugin(window.ScrollTrigger);
    }

    initHeroAnimation(gsap);
    initFeatureSectionAnimation(gsap);
    initPathSectionAnimation(gsap);
    initContactSectionAnimation(gsap);
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHomeAnimations, { once: true });
} else {
    initHomeAnimations();
}
