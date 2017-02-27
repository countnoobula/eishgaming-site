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
        });
        </script>
@unless (is_null(config('services.google.id')))

        <script>
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '{{ config('services.google.id') }}']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
        </script>
@endunless
