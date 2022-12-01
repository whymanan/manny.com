<?php get_section('aeps2/app/Aeps'); ?>
<script src="<?php echo base_url(ASSETS) ?>/vendor/datatables.net/js/jquery.dataTables.min.js" charset="utf-8"></script>

<script type="text/javascript">
    $(document).ready(function() {




         var $transectionlist = $('#transectionlist');
           var duid = '<?php echo $this->session->userdata("user_id") ?>';
      var Api = '<?php echo base_url('aeps2/PaySprintAepsController/'); ?>';
      var $table = $transectionlist.DataTable({
      "searching": true,
      "processing": true,
      "serverSide": true,
      "deferRender": true,
      "language": {
        "processing": '<img width="24" height="24" src="<?php echo base_url('optimum/loading.svg') ?>" />',
        "emptyTable": "No distributors data available ...",
      },
      "order": [],
      "ajax": {
        url: Api + "get_transectionlist?key=" + duid + "&list=all",
        type: "GET",
      },

      "pageLength": 10
    });

 $("#simplefilter").click(function(event) {
      event.preventDefault();
        // console.log($(searchValue).val())
    url = Api + "get_transectionlist?key=" + duid + "&date_from=" + $('#date_from').val() + "&date_to=" + $('#date_to').val() + "&searchValue="+  $('#searchValue').val() +"&searchByCat=" + $('#searchByCat').val() + "&search=simple&list=all";
       $table.ajax.url(url).load();

    });
$("#clear").click(function(event) {
      event.preventDefault();

   url = Api + "get_transectionlist?key=" + duid + "&list=all";
       $table.ajax.url(url).load();

    });


//

    });
</script>
