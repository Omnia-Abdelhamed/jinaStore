         <!-----start footer --->
         <footer class="container-fluid  border-top arabic">
           <div class="container"><br>
        <div class="row ">
          <div class="col-lg-4 col-md-6 col-12">
              <a href="index.php" class=" "><img src="img/<?php echo $settings_data['logo']; ?>" class="pad-10" width="60%">  </a>
              <br><br>
              <a href="<?php echo $settings_data['facebook']; ?>" ><img src="img/facebook.png" width="50px" class="pad-10"> </a>
              <a href="<?php echo $settings_data['instagram']; ?>" ><img src="img/instagram.png" width="50px" class="pad-10"> </a>
             <br> <br></div>
               <div class="col-lg-4 col-md-6 col-12">
            <h5>معلومات الشركة</h5>
               <ul class="navbar-nav  w-100 pad-0" >
                    <li class="nav-item "> 
                        <a class="nav-link  "  href="about-ar.php" >عنا</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link  "  href="about-ar.php" >  سياسة الخصوصية</a>
                    </li>
                   <li class="nav-item "> 
                        <a class="nav-link  "  href="about-ar.php" >  شروط التوصيل</a>
                    </li>
                  <li class="nav-item ">
                        <a class="nav-link  "  href="about-ar.php" >  الشروط والأحكام</a>
                    </li>
                    </ul>  
             <br> <br></div>
        
                   <!-- <div class="col-lg-3 col-md-6 col-12">
            <h5> التطبيق على الهاتف المحمول  </h5>
             <a href="" > <img src="img/app.png" class="pad-10"></a> 
           <a href=""> <img src="img/google.png" class="pad-10"></a> 
             <br> <br></div> -->
      <div class="col-lg-4 col-md-6 col-12">
            <h5>أتصل بنا</h5>
              <ul class="navbar-nav  w-100 pad-0" >
                    <li class="nav-item "> 
                        <a class="nav-link  "  href="tel:<?php echo $settings_data['phone']; ?>" > أتصل: <?php echo $settings_data['phone']; ?></a>
                    </li>
                    <li class="nav-item ">
                      <label style="display: inline !important;">البريد الالكترونى : </label>
                      <a class="nav-link  "  href="" style="display: inline !important;">  <?php echo $settings_data['email']; ?></a>
                    </li>     
                    </ul> 
                  
           <br> <br> </div>
               </div></div></footer> 

    <div class="container-fluid bg-b ">
                 <div class="row ">
                <p class="col-12"><br>Copyright ©2020 All rights reserved | This template is made with  by <a href="" class="main-color">blueZone</a></p>
        </div></div>
    
       <div class="static">
    <a href="https://api.whatsapp.com/send?phone=<?php echo $settings_data['whatsapp']; ?>&text=I'm%20interested%20in%20your%20services" target="_blank"  class="float-right bg-g " title="whatsapp"><i class="fab fa-whatsapp"></i></a>
          <a href="tel:<?php echo $settings_data['phone']; ?>"  class="float-right    bg-info" title="message"><i class="fas fa-phone-volume"></i></a>
          <a href="mailto:<?php echo $settings_data['email'] ?>"  class="float-right   bg-danger" title="email"><i class="fas fa-envelope "></i> </a>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>  
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
          <script src="js/all.min.js"></script> 
        <script src="js/wow.min.js"></script>
     <script>
              new WOW().init();
              </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    <script src="js/main-js.js"></script>
</body>
    
</html>
<?php ob_end_flush(); ?>