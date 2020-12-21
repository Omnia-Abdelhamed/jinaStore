<?php
include 'navbar.php';?>    
      <!-----end nav ---> 
   <header class="container-fluid bg-light border-bottom arabic">
     <div class="container">
         <ul class="nav product" >
       <li class="nav-item  ">  <a class="nav-link  "  href="index.php" > الرئيسية </a>	
        </li>
              <li class="nav-item  ">  <a class="nav-link  "  href="" >  <i class="fas fa-arrow-left " style="font-size: 20px"></i></a>	
        </li>
    <li class="nav-item ">  <a class="nav-link   "  href="about-ar.php" >عنا</a>
    </li>    
    </ul>
     
     </div>
    </header>
  <!--- --->
       <div class="container arabic "><br><br>
        <div class="row">
            <h5><?php echo $settings_data['about_title']; ?></h5>
            <p><?php echo $settings_data['about']; ?></p>
        </div>
    </div>
        <?php
        include "footer_ar.php";
        ?> 