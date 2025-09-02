document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('sortSelect');
    if (!select) return;

    select.addEventListener('change', function () {
        const url = new URL(window.location.href);
        const params = url.searchParams;

        // set/clear sort
        if (this.value) {
            params.set('sort', this.value);
        } else {
            params.delete('sort');
        }
        // reset page khi đổi sort
        params.delete('page');
        
        url.search = params.toString();
        window.location.assign(url.toString());
    });
});