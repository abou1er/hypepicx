<!-- all cards -->

<?php 
 while($dataImg = $dataImage->fetch()){
echo  
                    "<a class='lien' href='imgSelected.php?id_image=".$dataImg["id_image"]."'> 
                            
                            
                            
                        <div class='parent-cadre' style>
                                <img class='img-cadre'  src ='img/cadregold.png'> 
                            
                            
                            <div class='interieurs' style='background-image: url(".$dataImg['url_image']. ");'> 
                            
                            
                            
                                <img style='max-width:100% ; max-height:100%;  ' src = " .$dataImg['url_image']. "> 
                            </div>
                            
                            
                            
                            
                            
                            <div class='infocarte'>
                            
                                    <div class='titre'>

                                        <span>". $dataImg["title_image"] ."</span>
                            
                                    </div>
                            
                            
                                    <div class=datepostimg'>
                            
                                        ". $dataImg["date_post"] ."

                            
                                    </div>
                            
                            </div>

                        </div>
                            
                    </a>";
                            
                // fin carte
                            
                                    //  var_dump($sortByLevel);
             }
?>