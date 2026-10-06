const themeToggles = document.querySelectorAll('[data-theme-toggle]');

if (themeToggles.length > 0) {
    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)');
    let preferredTheme = null;

    try {
        const storedTheme = localStorage.getItem('theme');
        preferredTheme = ['light', 'dark'].includes(storedTheme) ? storedTheme : null;
    } catch {}

    const applyTheme = () => {
        const isDark = preferredTheme === 'dark' || (preferredTheme === null && systemTheme.matches);

        document.documentElement.classList.toggle('dark', isDark);

        themeToggles.forEach((button) => {
            button.setAttribute('aria-pressed', String(isDark));
            button.title = isDark ? 'Aktifkan mode terang' : 'Aktifkan mode gelap';
            button.hidden = false;
        });
    };

    themeToggles.forEach((button) => {
        button.addEventListener('click', () => {
            preferredTheme = document.documentElement.classList.contains('dark') ? 'light' : 'dark';

            try {
                localStorage.setItem('theme', preferredTheme);
            } catch {}

            applyTheme();
        });
    });

    systemTheme.addEventListener('change', applyTheme);
    window.addEventListener('storage', (event) => {
        if (event.key === 'theme' || event.key === null) {
            preferredTheme = ['light', 'dark'].includes(event.newValue) ? event.newValue : null;
            applyTheme();
        }
    });

    applyTheme();
}
