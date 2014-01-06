<?php
$keywords = empty($_GET['keywords'])?'Search problems..':$_GET['keywords'];
?>
<!-- Search box -->
<article class="box is-post">
<form class="fullwidth" method="get" action="/search.php">
    <input type="text" value="<?php echo $keywords; ?>" onfocus="this.value='';" onblur="this.value='<?php echo $keywords; ?>';" name="keywords" />
</form>
</article>

