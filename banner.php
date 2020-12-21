<?php
    include_once 'banner_class.php';
    $banner_count=1;
    $banners= new Banners();
    $banners_data=$banners->select_all();
?>
<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">
    <?php foreach ($banners_data as $banner) { ?>
    <div class="carousel-item <?php if ($banner_count==1) { ?> active <?php } ?> h">
      <img class="d-block w-100 " src="img/<?php echo $banner['banner_image']; ?>" alt="<?php echo $banner_count; ?> slide">
    </div>
    <?php $banner_count++; } ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>