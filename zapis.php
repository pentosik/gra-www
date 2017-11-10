<script>
										  var pas_lvl=<?php echo $pas_start;?>;
										    //var pas_lvl=1;
											var obraz="/pas" + pas_lvl + ".png";
										 // '<img src="frontend/images/'+obraz+'"alt="" width="150" height="130"/>'
										document.getElementById("pas1").innerHTML='<img src="frontend/images/'+obraz+'"alt="" width="920" height="800"/>'	
										//document.getElementById("passtartowy").src="frontend/images/"+obraz;

									 </script>
										<!-- <img src="frontend/images/pas1.png" alt="" width="920" height="800" id="passtartowy"/> -->


                                         // $funkcja='document.getElementById(<?php echo $id?>).innerHTML="<img src="frontend/images/'+obraz+'" alt="" width="920" height="800"/>"';





                                          <?php
   
                $wyglad=$imgname.$level.'.png"';
                $srcx='"frontend/images/'.$wyglad.' alt="" width="920" height="800"/>"';
                $funkcja='document.getElementById("'.$id.'").innerHTML=<img src=';
                
               
                 echo $funkcja.$srcx;




                 var obraz="pas2.png";
                 var ident="pas1";
                 document.getElementById(ident).innerHTML='<img src="frontend/images/'+obraz+'" alt="" width="150" height="130"/>';
            ?>