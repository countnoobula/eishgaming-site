
<!-- jQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- jQuery ScrollTo Plugin -->
<script src="//balupton.github.io/jquery-scrollto/lib/jquery-scrollto.js"></script>

<!-- History.js -->
<script src="//browserstate.github.io/history.js/scripts/bundled/html4+html5/jquery.history.js"></script>

<!-- Ajaxify -->
<script src="//rawgithub.com/browserstate/ajaxify/master/ajaxify-html5.js"></script>

<!-- Timeago.js -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.5.3/jquery.timeago.min.js"></script>
<script>
$(function() {
    jQuery(".timeago").timeago();
})
</script>
@unless (is_null(config('services.google.id')))
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '{{ config('services.google.id') }}', 'auto');
  ga('send', 'pageview');

</script>
@endunless
