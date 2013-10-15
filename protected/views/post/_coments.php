 <div class="top-comment comment">
     <?php $usr = $data->getUser();  ?>
            <div class="left">
                <figure>
                    <img alt="" src="img/avatar01.jpg">
                </figure>
                <div class="border"></div>
            </div>
            <div class="right">
                <div class='text'>
                    <div class='name'><a href="#"><?php echo $usr->username;?></a></div>
                    <span class="date">March 22, 2012 | Responder</span>
                    <?php echo $data->c_body; ?>
                </div>
                <!-- respuesta comentarios-->
                
            </div>
  </div>
