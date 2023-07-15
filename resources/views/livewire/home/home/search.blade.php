<style>
    #search-results table {
        position: absolute;
        width: 100%;
        margin-top: 10px;
        border-collapse: collapse;
    }

    #search-results th,
    #search-results td {
        padding: 5px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #ddd;
    }

    #search-results th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    #search-results tbody tr:hover {
        background-color: #f5f5f5;
    }

    .color-red {
        background-color: #FF324D;
        color: #ffffff
    }
</style>
<div class="product_search_form radius_input search_form_btn">


    <div class="search-box">
        <form action="{{ route('search') }}" method="POST" class="d-flex search-form">
            @csrf
            <div class="input-group-prepend">
                <button type="submit" class="btn color-red p-2"><i class="fas fa-search ml-2"></i></button>
            </div>
            <input type="text" class="form-control ml-2" name="query" placeholder="جستجو..." id="search">

        </form>
        <div id="search-results" class="mt-0"></div>

    </div>

</div>


<script>
    $(document).ready(function() {
        $('form.search-form').submit(function(e) {
            e.preventDefault();
            var searchInput = $("input[id='search']");
            if (searchInput.val().length == 0) {
                $('#search-results').empty();
                $('#search-results').html(
                    '<p class="text-danger">لطفاً عبارت مورد جستجو را وارد کنید.</p>');
                return;
            }
            $.ajax({
                type: 'POST',
                url: '{{ route('search') }}',
                data: $(this).serialize(),
                success: function(response) {
                    var products = response.products;
                    var articles = response.articles;
                    var error = response.error;
                    var html = '';

                    if (error) {
                        $('#search-results').html(
                            '<br/> <span class="text-danger">لطفاً عبارت مورد جستجو را وارد کنید.</span>'
                        );
                    }

                    if (products.length > 0) {
                        html += '<h4>محصولات</h4>';
                        html += '<table class="table table-striped table-bordered">';
                        html += '<thead><tr><th>نام</th><th>توضیحات</th></tr></thead>';
                        html += '<tbody>';
                        for (var i = 0; i < products.length; i++) {
                            var product = products[i];
                            var productRoute =
                                '{{ route('product.single.index', ['id' => ':id', 'link' => ':link']) }}';
                            product.description = product.description.substr(0, 255) + (
                                product.description.length > 255 ? '...' : '');
                            productRoute = productRoute.replace(':id', product.id);
                            productRoute = productRoute.replace(':link', product.link);
                            html += '<tr><td><a href="' + productRoute + '">' +
                                '<img src="/uploads/' + product.img + '" alt="' + product
                                .title + '"/>' + '</a>' +
                                product
                                .title + '</td><td>' + product.description + '</td></tr>';
                        }
                        html += '</tbody></table>';
                    }
                    if (articles.length > 0) {
                        html += '<h4>مقاله ها</h4>';
                        html += '<table class="table table-striped table-bordered">';
                        html += '<thead><tr><th>عنوان</th><th>توضیحات</th></tr></thead>';
                        html += '<tbody>';
                        for (var i = 0; i < articles.length; i++) {
                            var article = articles[i];
                            var articleRoute =
                                '{{ route('article.single.index', ['link' => ':link']) }}';
                            article.body = article.body.substr(0, 255) + (article.body
                                .length > 255 ? '...' : '');
                            articleRoute = articleRoute.replace(':link', article.link);
                            html += '<tr><td><a href="' + articleRoute + '">' +
                                '<img src="/uploads/' + article.img + '" alt="' + article
                                .title + '" />' + article
                                .title + '</a></td><td>' + article.body + '</td></tr>';
                        }
                        html += '</tbody></table>';
                    }

                    if (products.length <= 0 && articles.length <= 0) {
                        $('#search-results').html(
                            '<p class="text-danger">نتیجه ای یافت نشد.</p>');
                    } else {
                        $('#search-results').html(html);
                    }
                    $('#search').on('input', function() {
                        $('#search-results').empty();
                    });
                }
            });
        });
    });
</script>
