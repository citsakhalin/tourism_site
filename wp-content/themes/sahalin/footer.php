</div><!-- .wrapper -->

<footer class="footer box">
    <div class="wrap clrfx">
	<div class="fot_raz">
	    <?php the_field('copiright', 'option'); ?>
	     <br /><a href="http://landingart.ru/" target="_blank" class="fotlogo clrfx">
       <img src="<?php echo get_template_directory_uri(); ?>/img/logoart.png" alt="">
      <span>Разработка сайта</span>
      
      
   </a>
	</div>
   <div class="fot_dva">
	    <?php the_field('contacts', 'option'); ?>
	   
	</div>
   <div class="fot_tri">
	     <?php wp_nav_menu( array( 'theme_location' => 'fmenu', 'menu_id' => 'fmenu' ) ); ?>
	</div>
   
    </div>
    <button class="sentok" data-trigger='modal' data-target='#modal-1'>Show Modal</button>
</footer><!-- .footer -->

<div class="nifty-modal fade-in-scale" id="modal-1">
	<div class="md-content">
		<div class='md-title'>
			<h3>Спасибо!</h3>
		</div>
		<div class='md-body'>
			<p>Ваше обращение получено и будет расмотрено в течение трех рабочих дней.</p>
			<p>Если обращение подразумевает ответ, то Вы его получите по указанным контактным данным.</p>
			<p>Спасибо, что воспользовались нашим сервисом!</p>
			<button class="btn btn-primary md-close">Закрыть</button>
		</div>
	</div>
</div>
<div class="md-overlay"></div>


<?php wp_footer(); ?>

<script>
	function handleNiftyEvent(event) {
		console.log(event)
	}
	$("#modal-1").on("show.nifty.modal", handleNiftyEvent)
	$("#modal-1").on("shown.nifty.modal", handleNiftyEvent)
	$("#modal-1").on("hide.nifty.modal", handleNiftyEvent)
	$("#modal-1").on("hidden.nifty.modal", handleNiftyEvent)
</script> 

<script>
(function($) {
$(function() {

  $('input.file-761, select').styler();

});
})(jQuery);

</script>                               
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter38131640 = new Ya.Metrika({
                    id:38131640,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/38131640" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
