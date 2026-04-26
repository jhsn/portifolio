const searchInput = document.querySelector('#search');

if (searchInput) {
    searchInput.addEventListener('focus', () => {
        document.body.dataset.searching = 'true';
    });

    searchInput.addEventListener('blur', () => {
        document.body.dataset.searching = 'false';
    });
}