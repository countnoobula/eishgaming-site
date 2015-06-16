<!-- Libraries -->
<script type="text/javascript" src="/js/jquery-v1.11.1.min.js"></script>
<script type="text/javascript" src="/js/jquery.timeago.js"></script>
<script type="text/javascript" src="/js/jquery.history.js"></script>
<script type="text/javascript" src="/js/Util.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    Util.init($('body'));
    History.Adapter.bind(window,'statechange',function(){
        var State = History.getState();
        Util.load(State.hash);
    });
});
</script>