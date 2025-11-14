$(document).ready(function () {
    let debounceTimer;

    $('#search').on('keyup', function () {
        clearTimeout(debounceTimer);
        const query = $(this).val();
        const searchUrl = $(this).data('url'); // safer

        debounceTimer = setTimeout(function () {
            $.ajax({
                url: searchUrl,
                type: 'GET',
                data: { query: query },
                beforeSend: function () {
                    $('#table-body').html(
                        `<tr><td colspan="7" class="text-center py-4">Loading...</td></tr>`
                    );
                },
                success: function (response) {
                    $('#table-body').html(response.html); // FIXED: use response.html
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error:', error);
                    $('#table-body').html(
                        `<tr><td colspan="7" class="text-center text-red-500 py-4">Search failed. Please try again.</td></tr>`
                    );
                }
            });
        }, 300); // 300ms debounce
    });
});
