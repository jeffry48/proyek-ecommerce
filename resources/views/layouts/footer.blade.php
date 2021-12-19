<footer id="footer"><!--Footer-->


    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Service</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Online Help</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">FAQ’s</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Daerah Hotel</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Jakarta</a></li>
                            <li><a href="#">Surabaya</a></li>
                            <li><a href="#">Bali</a></li>
                            <li><a href="#">Labuan Bajo</a></li>
                            <li><a href="#">Medan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Policies</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privecy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>About Us</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Brian - 218116713</a></li>
                            <li><a href="#">Jeffry - 218116724</a></li>
                            <li><a href="#">Lidya - 218116729</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <form action="#" method="POST" class="searchform">
                            @csrf
                            <input type="text" name="email" placeholder="Your email address" />
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->



<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('js/price-range.js')}}"></script>
<script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script>
    var ratedIndex = -1;
    $(document).ready(function () {
        $('.fa-star').mouseover(function(){
            resetStarColors();

            $('.fa-star').on('click',function(){
                ratedIndex=parseInt($(this).data('index'));
                $(this).parent().find('input[name=rating]').val(ratedIndex+1);
            });

            var currentIndex = parseInt($(this).data('index'));
            setStars(currentIndex);
        })
        $('.fa-star').mouseleave(function(){
            resetStarColors();

            if(ratedIndex!=-1){
                setStars(ratedIndex)
            }
        })
    });

    function setStars(max){
        for(var i=0;i<=max;i++)
            $('.fa-star:eq('+i+')').css('color','yellow');
    }

    function resetStarColors(){
        $('.fa-star').css('color','gray');
    }
</script>

</body>
</html>
