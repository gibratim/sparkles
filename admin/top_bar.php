<script type="text/javascript">
 setInterval(function(){
  $('#top_bar_div').load('top_bar_data.php');
    }, 5000);
</script>
<div id="top_bar_div">
<?php 
include("top_bar_data.php");
?>
</div>