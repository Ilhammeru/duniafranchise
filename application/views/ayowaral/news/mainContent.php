<!-- row start left banner - right banner -->
<div class="div-search" style="display: none;"></div>

<div class="div-main-content">
    <div class="row" style="padding: 0 1em;">
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2" style="margin-top: 0.8em; padding:0;">
            <!-- button -->
            <button class="btn-member btn-member-banner-news">member banner</button>
            <!-- end button -->

            <div>
                <?php for ($pr = 0; $pr < count($premImg); $pr++) : ?>
                    <img class="img-left lazyload" onclick="navigate(<?= $premId[$pr]; ?>, 'ayowaralaba/franchise/detail_brand/<?= $premId[$pr]; ?>')" data-src="<?= $premImg[$pr]; ?>" alt="">
                <?php endfor; ?>
            </div>

            <!-- button -->
            <button class="btn-member">article</button>
            <!-- end button -->

            <!-- article shortcut -->
            <div class="card card-article-shortcut">
                <div class="card-body">
                    <ul>
                        <?php for ($art = 0; $art < count($artTitle); $art++) : ?>
                            <li><?= $artTitle[$art]; ?></li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
            <!-- end article shortcut -->

            <!-- button -->
            <button class="btn-member">member banner</button>
            <!-- end button -->

            <div>
                <?php for ($lf = 0; $lf < count($leftImg); $lf++) : ?>
                    <img class="img-left lazyload" data-src="<?= $leftImg[$lf]; ?>" alt="" onclick="navigate(<?= $leftId[$lf]; ?>, 'ayowaralaba/franchise/detail_brand/<?= $leftId[$lf]; ?>')">
                <?php endfor; ?>
            </div>
        </div>

        <div class="<?= $col; ?>" id="rekap-news" style="margin-top: 0.8em;">
            <!-- button -->
            <button class="btn-member btn-member-news">berita / artikel</button>
            <!-- end button -->

            <!-- panel navigation -->
            <div class="card card-navigation-news">
                <div class="card-body">
                    <div>
                        <div class="div-1" onclick="navigate('ayowaralaba/home')">
                            <i class="fa fa-home"></i>
                            <span>Kembali ke Beranda</span>
                        </div>
                        <div class="div-2" onclick="navigate('ayowaralaba/news')">
                            <span>Semua Berita</span>
                            <i class="fa fa-bars"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end panel navigation -->

            <div class="row news-target"></div>
            <div class="pagination-news"></div>

            <!-- detail news target -->
            <div class="card detail-news">
                <div class="card-body">
                    <h4 class="detail-news-title"></h4>

                    <div class="detail-activity-news">
                        <div id="calendar">
                            <i class="fa fa-calendar"></i>
                            <span class="target-calendar-news"></span>
                        </div>
                        <div id="user">
                            <i class="fa fa-user"></i>
                            <span class="target-editor-news">Ilham meru gumilang</span>
                        </div>
                        <div id="bookmarks">
                            <i class="fa fa-bookmark-o"></i>
                            <span class="target-bookmark-news">Usaha kecil menengah</span>
                        </div>
                        <div id="visit-times">
                            <i class="fa fa-eye"></i>
                            <span class="target-visitor-news">Dilihat 200 kali</span>
                        </div>
                    </div>

                    <div class="target-detail-news">

                    </div>
                </div>
            </div>
            <!-- end detail news target -->

            <!-- panel navigation -->
            <div class="card card-navigation-news">
                <div class="card-body">
                    <div>
                        <div class="div-1" onclick="navigate('ayowaralaba/home')">
                            <i class="fa fa-home"></i>
                            <span>Kembali ke Beranda</span>
                        </div>
                        <div class="div-2" onclick="navigate('ayowaralaba/news')">
                            <span>Semua Berita</span>
                            <i class="fa fa-bars"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end panel navigation -->
        </div>

    <script>
        $(document).ready(() => {
            get_news(0)
        })

        function get_news(page) {
            $.ajax({
                type: 'get',
                url: '<?= site_url(); ?>ayowaralaba/news/get_news/' + page,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('.pagination-news').html(response.pagination)
                    var tr = ''

                    for (var i = 0; i < response.titleNews.length; i++) {
                        tr += '<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6" style="padding: 0 0.4em;">' +
                            '<div class="card card-page-news">' +
                            '<div class="card-body">' +
                            '<div>' +
                            '<img style="width: 100%; height: auto;" src="' + response.thumbNews[i] + '">' +
                            '<h4 class="page-news-title" onclick="detail_news(' + response.idNews[i] + ')">' + response.titleNews[i] + '</h4>' +
                            '<p class="page-news-content">' + response.contNews[i] + '</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                    }

                    $('.news-target').html(tr)
                    $('.card.detail-news').hide();
                    $('#right-banner-news').hide();
                }
            })
        }

        function detail_news(id) {
            $('#right-banner-news').show();
            $('.news-target').hide();

            $('.card.detail-news').show();

            $('#rekap-news').removeAttr('class');
            var col = 'col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8';

            $('#rekap-news').addClass(col);

            $('.card-navigation-news').show();

            $.ajax({
                type: 'post',
                data: {
                    id: id
                },
                url: '<?= site_url('ayowaralaba/news/detail_brand'); ?>',
                dataType: 'json',
                success: function(response) {
                    console.log(response);

                    $('.target-calendar-news').text(response.time);
                    $('.target-editor-news').text(response.creator);

                    var img = '<img src="' + response.image + '" style="width:100%; height: auto; margin-bottom: 0.5em;" />';
                    var content = '<div class="content-input">' + response.content + '</div>';
                    $('.target-detail-news').html(img);
                    $('.target-detail-news').append(content);
                    $('.detail-news-title').text(response.title);
                }
            })
        }
    </script>