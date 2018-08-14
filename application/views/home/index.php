<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-6 col-md-6 center-block no-float" >
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
<div id="myCarousel" class="carousel slide" data-ride=”carousel”>
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
      <!-- Carousel items -->
      <div class="carousel-inner">
    <div class="active item">
      <img src="<?php echo base_url(); ?>assets/img/fotografias/1-sm.jpg" alt="First slide">
    </div>
    <div class="item">
      <img  src="<?php echo base_url(); ?>assets/img/fotografias/2-sm.jpg" alt="Second slide">
    </div>
    <div class="item">
      <img  src="<?php echo base_url(); ?>assets/img/fotografias/3-sm.jpg" alt="Third slide">
    </div>
  </div>
  <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
<script>
    $(document).ready(function(){
        $('.myCarousel').carousel()
    });
</script>


  