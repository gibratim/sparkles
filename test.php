<script type="text/javascript" src="jscroll-master/jquery-1.9.1.js"></script>
<script type="text/javascript" src="jscroll-master/Gruntfile.js" ></script>
<script type="text/javascript" src="jscroll-master/jquery.jscroll.js" ></script>
<script type="text/javascript" src="jscroll-master/jquery.jscroll.min.js" ></script>
<script type="text/javascript">
$(document).ready(function()
{ 
$('.data_content').jscroll({
    loadingHtml: '<div style="margin:auto;width:100px;"><img src="images/loading.gif" width="100px;" alt="Loading" /></div>',
    padding: 20,
    nextSelector: 'a.loadNext:last',
	autoTriggerUntil:1
});
});
</script>
<div class="data_content">
<?php 
$count=0;
while($count<30){
echo "<h1>Testing line $count</h1>";
$count++;
} ?>
<a href="test.php" class="loadNext">More>>></a>
</div>