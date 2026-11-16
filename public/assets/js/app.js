function confirmHapus() {
    return confirm('Yakin ingin menghapus data ini?');
}

(function () {
    function ready(fn) {
        if (document.readyState !== 'loading') fn();
        else document.addEventListener('DOMContentLoaded', fn);
    }

    // YYYY-MM-DD atau d-M-Y -> timestamp (untuk sorting tanggal)
    var MONTHS = {
        jan: 0, feb: 1, mar: 2, apr: 3, may: 4, jun: 5,
        jul: 6, aug: 7, sep: 8, oct: 9, nov: 10, dec: 11
    };

    function parseDate(text) {
        var m = text.match(/^(\d{1,2})-([A-Za-z]{3})-(\d{4})$/);
        if (!m) return null;
        var month = MONTHS[m[2].toLowerCase()];
        if (month === undefined) return null;
        return new Date(parseInt(m[3], 10), month, parseInt(m[1], 10)).getTime();
    }

    function cellSortValue(row, index) {
        var cell = row.cells[index];
        if (!cell) return { num: null, text: '' };
        var text = (cell.textContent || '').replace(/\s+/g, ' ').trim();
        var date = parseDate(text);
        if (date !== null) return { num: date, text: text.toLowerCase() };
        var digits = text.replace(/[^0-9.-]/g, '');
        if (digits !== '' && !isNaN(parseFloat(digits))) {
            return { num: parseFloat(digits), text: text.toLowerCase() };
        }
        return { num: null, text: text.toLowerCase() };
    }

    function makeSorter(table, index) {
        var direction = 1;
        return function () {
            var tbody = table.querySelector('tbody');
            if (!tbody) return;
            var rows = Array.prototype.slice.call(tbody.querySelectorAll('tr'));
            rows.sort(function (a, b) {
                var av = cellSortValue(a, index);
                var bv = cellSortValue(b, index);
                if (av.num !== null && bv.num !== null) return (av.num - bv.num) * direction;
                return av.text.localeCompare(bv.text) * direction;
            });
            for (var i = 0; i < rows.length; i++) tbody.appendChild(rows[i]);

            var headers = table.querySelectorAll('thead th');
            for (var j = 0; j < headers.length; j++) {
                headers[j].classList.remove('asc', 'desc');
            }
            headers[index].classList.add(direction === 1 ? 'desc' : 'asc');
            direction *= -1;
        };
    }

    ready(function () {
        // Pesan sukses/error hilang otomatis
        var messages = document.querySelectorAll('.msg');
        for (var i = 0; i < messages.length; i++) {
            (function (el) {
                setTimeout(function () {
                    el.style.opacity = '0';
                    setTimeout(function () { el.style.display = 'none'; }, 420);
                }, 4200);
            })(messages[i]);
        }

        // Klik header tabel untuk sorting
        var tables = document.querySelectorAll('table.table');
        for (var t = 0; t < tables.length; t++) {
            var headers = tables[t].querySelectorAll('thead th');
            for (var h = 0; h < headers.length; h++) {
                if (headers[h].textContent.replace(/\s+/g, ' ').trim().toLowerCase() === 'aksi') continue;
                headers[h].classList.add('sortable');
                headers[h].setAttribute('role', 'button');
                headers[h].setAttribute('tabindex', '0');
                headers[h].addEventListener('click', makeSorter(tables[t], h));
                headers[h].addEventListener('keydown', function (e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            }
        }

        // Filter tanggal langsung submit saat diubah
        var dateFilters = document.querySelectorAll('form[method="get"] input[type="date"]');
        for (var d = 0; d < dateFilters.length; d++) {
            dateFilters[d].addEventListener('change', function () {
                if (this.form) this.form.submit();
            });
        }
    });
})();
