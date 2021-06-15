<!-- end main body home non footer -->
<div class="div-footer">
    <nav>
        <div class="footer-navigation">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-footer-1">
                    <p class="p-footer-navigation">navigation</p>

                    <ul class="nav flex-column nav-footer">
                        <li class="nav-item nav-item-footer">
                            <a class="nav-link nav-link-footer" href="<?= base_url('ayowaralaba/home'); ?>">Beranda</a>
                        </li>
                        <li class="nav-item nav-item-footer">
                            <a class="nav-link nav-link-footer" href="<?= base_url('ayowaralaba/franchise');?>">daftar franchise</a>
                        </li>
                        <li class="nav-item nav-item-footer">
                            <a class="nav-link nav-link-footer" href="<?= base_url('ayowaralaba/news');?>">berita / news</a>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-footer-2">
                    <p class="p-footer-navigation">info perusahaan</p>

                    <ul class="nav flex-column nav-footer">
                        <li class="nav-item nav-item-footer">
                            <a class="nav-link nav-link-footer" href="#">Tentang kami</a>
                        </li>
                        <li class="nav-item nav-item-footer">
                            <a class="nav-link nav-link-footer" href="#">iklan dengan kami</a>
                        </li>
                        <li class="nav-item nav-item-footer">
                            <a class="nav-link nav-link-footer" href="#">kontak kami</a>
                        </li>
                        <li class="nav-item nav-item-footer">
                            <a class="nav-link nav-link-footer" href="#">ketentuan dan persyaratan</a>
                        </li>
                        <li class="nav-item nav-item-footer">
                            <a class="nav-link nav-link-footer" href="#">pusat bantuan</a>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 col-footer-3">
                    <div class="row">
                        <div class="col-xl-6 col-md-6">
                            <p class="p-footer-navigation">temukan kami</p>
                            <a class="btn-twitter" target="_blank" href="https://twitter.com/intent/follow?original_referer=https%3A%2F%2Fwww.ayowaralaba.com%2F&amp;ref_src=twsrc%5Etfw&amp;region=follow_link&amp;screen_name=AyoWaralaba_ID&amp;tw_p=followbutton">
                                <i class="fa fa-twitter"></i>
                                <span>Ikuti @AyoWaralaba_ID</span>
                            </a>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <img src="<?= base_url(); ?>ayowaral-images/logo-ayowaralaba.png" alt="..." style="width: 100%; height: auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<script>
    function navigate(url, target = '') {
        if (Number.isInteger(url)) {
            var page = '<?= base_url(); ?>' + target;
            console.log(page);
            window.location = page;
        } else {
            var page = '<?= base_url(); ?>' + url;
            window.location = page;
        }
    }
</script>
</body>

</html>