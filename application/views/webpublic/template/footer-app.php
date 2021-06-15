
			</div><!-- col -->
		</div><!-- row -->

    </div>
    <!-- content-wrapper -->
    
  </div>
  <!-- container -->

</body>

<footer class="footer">

	<!-- Footer Links -->
  	<div class="container-fluid text-center">

    	<!-- Grid row -->
    	<div class="row" style="margin-left:100px; text-align: left">

      		<!-- Grid column -->
      		<div class="col-md-2" style="padding-top:50px">

        		<!-- Links -->
        		<h5><b>Navigation</b></h5>

        		<hr>

        		<ul class="list-unstyled">
          			<li>
            			<a href="<?=site_url('home');?>">Home</a>
          			</li>
          			<li>
            			<a href="<?=site_url('franchises-list');?>">Daftar Franchise</a>
          			</li>
          			<li>
            			<a href="<?=site_url('news');?>">Article / Berita</a>
          			</li>
          			<li>
            			<a href="#!">Figure</a>
          			</li>
       			</ul>
		    </div>
		    <!-- Grid column -->

		    <!-- Grid column -->
      		<div class="col-md-2" style="padding-top:50px">

        		<!-- Links -->
        		<h5><b>Dunia Franchise</b></h5>

        		<hr>

        		<ul class="list-unstyled">
          			<li>
            			<a href="<?=site_url('home/about_us');?>">About Us</a>
          			</li>
          			<li>
            			<a href="#!">Join Member Banner</a>
          			</li>
          			<li>
            			<a href="#!">Syarat & Ketentuan</a>
          			</li>
          			<li>
            			<a href="#!">Pusat Bantuan</a>
          			</li>
       			</ul>
		    </div>
		    <!-- Grid column -->

		    <!-- Grid column -->
      		<div class="col-md-2" style="padding-top:50px">

        		<!-- Links -->
        		<h5><b>Find Us</b></h5>

        		<hr>

        		<ul class="list-unstyled">
          			<li>
                  <a href=""><i class="fa fa-facebook-square"></i></a>
                  <a href=""><i class="fa fa-instagram"></i></a>
                  <a href=""><i class="fa fa-twitter-square"></i></a>
          			</li>
          			<li>
            			<a href="#!">@dunifranchise</a>
          			</li>
       			</ul>
		    </div>
		    <!-- Grid column -->

		    <!-- Grid column -->
		    <div class="col-md-6" style="padding-top: 75px;text-align: center">

		       <img src="<?=base_url() . $logo2Dir;?>" style="width: 250px;">
           <p>All right reserved &copy; 2020 Dunia Franchise</p>

		    </div>
		    <!-- Grid column -->

		</div>

  	</div>
  	<!-- Footer Links -->

</footer>

<script type="text/javascript">

  var accessName = "<?php echo $titlePageRight;?>";

    function getLocation() {
        
        if (navigator.geolocation == true) {

            navigator.geolocation.getCurrentPosition(showPosition);

        } else {
          
           recordVisitor(); 
        }

    }

    function showPosition(position) {
        
        var x = position.coords.latitude + "," + position.coords.longitude;

        var log = "<?php echo $log;?>";

        $.ajax({
            url: "<?=site_url('home/get_location');?>",
            type: 'post',
            data :{
                location : x,
                accessName : accessName,
                log : log
            },
            dataType: 'json'
        });

    }

    function recordVisitor() {
      var x = "";
      var log = "<?php echo $log;?>";

        $.ajax({
            url: "<?=site_url('home/get_location');?>",
            type: 'post',
            data :{
                location : x,
                accessName : accessName,
                log : log
            },
            dataType: 'json'
        });

    }

    $(window).on('load', function () {

        getLocation();
    $(this).scrollTop(0);

    });

    $(document).ready(function(){
    $(this).scrollTop(0);
});

</script>

<!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
<!-- Histats.com  START  (aync)-->
<!-- <script type="text/javascript">var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.start', '1,4528305,4,511,95,18,00000000']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
(function() {
var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
hs.src = ('//s10.histats.com/js15_as.js');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();</script>
<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4528305&101" alt="counter code" border="0"></a></noscript> -->
<!-- Histats.com  END  -->


</html>