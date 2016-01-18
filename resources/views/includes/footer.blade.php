<hr>
<script type="text/javascript" src="{{ asset("js/jquery-1.11.1.js")}}"></script>
<script type="text/javascript" src="{{ asset("js/jquery-ui.js")}}"></script>
<script type="text/javascript" src="{{ asset("js/bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{ asset("js/bootstrap-sortable.js")}}"></script>
<script type="text/javascript" src="{{ asset("js/moment.min.js")}}"></script>

<div id="copyright text-right">© Copyright 2015 Täby Fotbollsklubb</div>

<script>
    $(function() {
        $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd'}).val();
    });

    (function () {
        var $table = $('table');
        $table.on('sorted', function () {});
    }());
</script>

