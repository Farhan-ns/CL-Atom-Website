// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark')
}

function darkModeSwitch() {
    return {
        isDark: false,

        init() {
            // Initialize dark mode state based on current theme
            this.isDark = document.documentElement.classList.contains('dark');

            // Watch for changes to the dark class (in case it's changed elsewhere)
            this.watchForThemeChanges();
        },

        toggleDarkMode() {
            if (this.isDark) {
                // Switch to light mode
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
                this.isDark = false;
            } else {
                // Switch to dark mode
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
                this.isDark = true;
            }
        },

        watchForThemeChanges() {
            // Create a MutationObserver to watch for class changes on the html element
            const observer = new MutationObserver(() => {
                this.isDark = document.documentElement.classList.contains('dark');
            });

            observer.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ['class']
            });
        }
    }
}