<!-- row start left banner - right banner -->
<div class="row" style="padding: 0 1em;">
    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2" style="margin-top: 0.8em; padding:0;">
        <!-- button -->
        <button class="btn-member">member banner</button>
        <!-- end button -->

        <div>
            <?php for ($pr = 0; $pr < count($premImg); $pr++) : ?>
                <img class="img-left lazyload" data-src="<?= $premImg[$pr]; ?>" alt="">
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
                <img class="img-left lazyload" data-src="<?= $leftImg[$lf]; ?>" alt="">
            <?php endfor; ?>
        </div>
    </div>

    <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10" style="margin-top: 0.8em; padding: 0 0.5em;">
        <div class="div-back-btn">
            <button class="back-btn">klik disini untuk kembali ke beranda</button>
        </div>

        <!-- button -->
        <button class="btn-member daftar-franchise">daftar franchise</button>
        <!-- end button -->

        <!-- panel navigation -->
        <div class="card card-navigation">
            <div class="card-body">
                <div>
                    <div class="div-1" onclick="navigate('ayowaralaba/home')">
                        <i class="fa fa-home"></i>
                        <span>Kembali ke Beranda</span>
                    </div>
                    <div class="div-2" onclick="navigate('ayowaralaba/franchise')">
                        <span>Semua Franchise</span>
                        <i class="fa fa-bars"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- end panel navigation -->

        <!-- panel search -->
        <div class="card card-search">
            <div class="card-body">
                <span>atur berdasarkan</span>
                <!-- Single button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle btn-search" data-value-sorting="1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Terpopuler - Kurang populer <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <a onclick="do_sorting(1, 'Terpopuler - Kurang populer')" class="dropdown-item dr-link" href="#">Terpopuler - Kurang populer</a>
                        <a onclick="do_sorting(2, 'Kurang Populer - Terpopuler')" class="dropdown-item dr-link" href="#">Kurang Populer - Terpopuler</a>
                        <a onclick="do_sorting(3, 'A - Z')" class="dropdown-item dr-link" href="#">A - Z</a>
                        <a onclick="do_sorting(4, 'Z - A')" class="dropdown-item dr-link" href="#">Z- A</a>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end panel search -->

        <!-- panel detail brand -->
        <div class="card card-detail-franchise">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-2 col-12 text-center">
                        <div>
                            <i class="fa fa-globe"></i>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-7 col-12">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h5 class="detail-franchise-name">Franchise Name</h5>
                                <p class="helper-text-detail-franchise">Detial franchise name</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                                <table class="table-detail-franchise">
                                    <tbody>
                                        <tr>
                                            <td class="detail-franchise-label" id="detail-contact">Kontak</td>
                                            <td class="detail-franchise-semicolon"> :</td>
                                            <td class="detail-franchise-value" id="detail-contact-value"><strong>Marketing</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="detail-franchise-label" id="detail-phone">Telepon</td>
                                            <td class="detail-franchise-semicolon"> :</td>
                                            <td class="detail-franchise-value" id="detail-phone-value">
                                                <a href="">0888888</a>
                                                <br>
                                                <span>Luar jawa</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="detail-franchise-label" id="detail-bb">Pin BB</td>
                                            <td class="detail-franchise-semicolon"> :</td>
                                            <td class="detail-franchise-value" id="detail-bb-value"></td>
                                        </tr>
                                        <tr>
                                            <td class="detail-franchise-label" id="detail-email">E-mail</td>
                                            <td class="detail-franchise-semicolon"> :</td>
                                            <td class="detail-franchise-value" id="detail-email-value"></td>
                                        </tr>
                                        <tr>
                                            <td class="detail-franchise-label" id="detail-invest">Investasi</td>
                                            <td class="detail-franchise-semicolon"> :</td>
                                            <td class="detail-franchise-value" id="detail-invest-value"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" style="border-right: 1px solid #e6e6e6;">
                                <div class="detail-text-value"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <div class="detail-image-value"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-detail-description">
            <div class="col-12">
                <div class="card card-detail-description">
                    <div class="card-body">
                        <div class="detail-description-value"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end panel detail brand -->

        <!-- list franchise -->
        <div class="target-franchise row" style="padding: 0 0.8em;"></div>

        <div class="text-center">
            <div class="pagination-franchise" data-page-active="0"></div>
        </div>
        <!-- end list franchise -->

        <!-- center banner -->
        <div class="center-banner-page-news">
            <?php for ($i = 0; $i < count($centerImg); $i++) : ?>
                <img class="lazyload" data-src="<?= $centerImg[$i]; ?>" alt="" style="width:100%; height: auto; margin: 0.8em 0; ">
            <?php endfor; ?>
        </div>
        <!-- end center banner -->

        <div class="div-back-btn">
            <button class="back-btn">klik disini untuk kembali ke beranda</button>
        </div>
    </div>


    <script>
        $(document).ready(() => {
            $('.back-btn').click((e) => {
                e.preventDefault()

                var page = '<?= site_url('ayowaralaba/home'); ?>'
                window.location = page;
            })

            $('.pagination-franchise').on('click', 'a', function(e) {
                e.preventDefault()
                var pageno = $(this).attr('data-ci-pagination-page')
                var val = $('.btn-search').attr('data-value-sorting');
                get_franchise(pageno, val)
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");
            })

            get_franchise(0, 1)
        })

        function do_sorting(value, text) {
            //change attribute to main button 
            $('.btn-search').attr('data-value-sorting', value)

            //change text 
            var caret = '<span class="caret"></span>'
            $('.btn-search').text(text)
            $('.btn-search').append(caret)

            get_franchise(0, value)
        }

        function get_franchise(page, sorting) {
            $.ajax({
                type: 'get',
                url: '<?= site_url(); ?>ayowaralaba/franchise/get_franchise/' + sorting + '/' + page,
                dataType: 'json',
                success: function(response) {
                    //manipulate page 
                    $('.panel-navigation').hide()
                    $('.card-detail-franchise').hide();
                    $('.row-detail-description').hide();
                    $('.div-back-btn').show()
                    $('.panel-search').show()
                    $('.center-banner-page-news').show()

                    $('.pagination-franchise').html(response.pagination)
                    var tr = ''

                    for (var i = 0; i < response.fName.length; i++) {
                        tr += '<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 col-franchise-menu">' +
                            '<div class="card card-franchise">' +
                            '<div class="card-body">' +
                            '<div class="card-img">' +
                            '<img class="lazyload" data-src="' + response.fImg[i] + '" alt="..." style="width: 100%; height: auto;">' +
                            '</div>' +
                            '<p class="franchise-name" onclick="detail_brand(' + response.fId[i] + ')">' + response.fName[i] + '</p>' +
                            '<p class="franchise-content">' + response.fText[i] + '</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                    }

                    $('.target-franchise').html(tr)
                }
            })
        }

        function detail_brand(id) {
            // manipulate page 
            $('.panel-navigation').show();
            $('.row-detail-description').show();
            $('.center-banner-page-news').hide();
            $('.div-back-btn').hide();
            $('.panel-search').hide();
            $('.target-franchise').html('');
            $('.pagination-franchise').html('');

            $.ajax({
                type: 'post',
                data: {
                    id: id
                },
                url: '<?= site_url('ayowaralaba/franchise/view_brand'); ?>',
                dataType: 'json',
                success: function(response) {
                    $('.card-detail-franchise').show();
                    $('.card-navigation').show();
                    $('.card-search').hide();

                    if (response.fInvest == null) {
                        var invest = '-';
                    } else {
                        var invest = response.fInvest;
                    }

                    var img = '<img class="lazyload img-detail" data-src="' + response.fImg + '" />';

                    var phone = '';
                    for (var i = 0; i < response.phone.length; i++) {
                        phone += '<a><strong>' + response.phone[i] + '</strong></a>' +
                            '<br>' +
                            '<span>( ' + response.area[i] + ' )</span>' +
                            '<br>' + '<br>';
                    }

                    $('#detail-invest-value').text(invest);
                    $('#detail-contact-value').text('Marketing');
                    $('#detail-phone-value').html('<strong>' + phone + '</strong>');
                    $('.detail-franchise-name').text(response.fName);
                    $('.detail-text-value').text(response.fText);
                    $('.helper-text-detail-franchise').html(response.fName + ' - kategori <span style="text-transform: uppercase; font-weight: bold;">minuman</span>');
                    $('.detail-image-value').html(img);
                    $('.detail-description-value').html(response.desc);
                }
            })
        }
    </script>