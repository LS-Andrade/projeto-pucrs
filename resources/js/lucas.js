document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('toggle-filters');
    const filters = document.getElementById('filters');

    if (toggleButton && filters) {
        toggleButton.addEventListener('click', () => {
            filters.classList.toggle('hidden');
        });
    }
});