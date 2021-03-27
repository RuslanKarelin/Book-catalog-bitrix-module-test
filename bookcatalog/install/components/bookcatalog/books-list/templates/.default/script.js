window.onload = function () {
    var bookFilterForm = document.getElementById('book-filter-form');

    bookFilterForm.addEventListener('change', function (event) {
        this.submit();
    });
}