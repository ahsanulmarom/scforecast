<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p>Copyright &copy; 2017 Baleni</p>
                </div>
                <div class="col-md-4">
                    <ul class="social-icons">
                        <li><a rel="nofollow" href="#" target="_parent"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="http://instagram.com/baleni_id"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <p>Developed by <a rel="nofollow" href="#" target="_parent"><em>AM-Nis-SJ</em></a></p>
                </div>
            </div>
        </div>
    </footer>

        
        <!-- JavaScript includes -->
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> 
        <script src="<?php echo base_url()?>assets/js/shoppingcart.js"></script>

    <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#kabupaten").change(function (){
                var url = "<?php echo site_url('Order/add_ajax_kec');?>/"+$(this).val();
                $('#kecamatan').load(url);
                return false;
            })
            
            $("#kecamatan").change(function (){
                var url = "<?php echo site_url('Order/add_ajax_des');?>/"+$(this).val();
                $('#desa').load(url);
                return false;
            })
        });
    </script>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="<?php echo base_url(); ?>assets/js/vendor/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/plugins.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        // navigation click actions 
        $('.scroll-link').on('click', function(event){
            event.preventDefault();
            var sectionID = $(this).attr("data-id");
            scrollToID('#' + sectionID, 750);
        });
        // scroll to top action
        $('.scroll-top').on('click', function(event) {
            event.preventDefault();
            $('html, body').animate({scrollTop:0}, 'slow');         
        });
        // mobile nav toggle
        $('#nav-toggle').on('click', function (event) {
            event.preventDefault();
            $('#main-nav').toggleClass("open");
        });
    });
    // scroll function
    function scrollToID(id, speed){
        var offSet = 0;
        var targetOffset = $(id).offset().top - offSet;
        var mainNav = $('#main-nav');
        $('html,body').animate({scrollTop:targetOffset}, speed);
        if (mainNav.hasClass("open")) {
            mainNav.css("height", "1px").removeClass("in").addClass("collapse");
            mainNav.removeClass("open");
        }
    }
    if (typeof console === "undefined") {
        console = {
            log: function() { }
        };
    }
    </script>
</body>
</html>