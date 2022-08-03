<!-- SEARCHBAR -->
<nav class="navbar navbar-expand-lg bg-light triRecherche">
  <div class="container-fluid">
  <a class="navbar-brand float-end">Trier par catégorie</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa-solid fa-magnifying-glass"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        

        <li class="nav-item mt-4 mb-3 me-4">
                        <form class="formleft" action="" method="get">
                            <div class="wrapper">
                                <button class="btn-food" type="submit" name="searching" value="hardfood" >hardfood</button>
                            </div>
                        </form>             
        </li>

        
        <li class="nav-item mt-3  mb-3 me-4">
        <form class="formleft" action="" method="get">
                    <button class="btnNa green rounded-pill" type="submit" name="searching" id="nature "value="nature">nature </button>                       
                </form>            
        </li>

        <li class="nav-item mt-3  mb-3 me-4">
                <form class="formleft" action="" method="get">
                    <div class="box">
                        <button class="but-ls" type="submit" name="searching" value="lifestyle" >lifestyle</button>
                    </div>
                </form>          
        </li>

        <li class="nav-item mt-3  mb-3 me-4">
                <form class="formleft" action="" method="get">
                            <button class="btn btn-1" type="submit" name="searching" value="anime" >anime</button>
                        </form>          
        </li>

        <li class="nav-item mt-3  mb-3 me-4">
        <form class="formleft" action="" method="get">
                            <button class="but-nft  rainbow rainbow-1 " type="submit" name="searching" value="nft" >NFT</button>
                        </form>           
        </li>

        <li class="nav-item dropdown">
          <ul class="dropdown-menu"> 
          </ul>
        </li>
        
      </ul>
        
      <a href="allImageMembre.php" class="me-3"><button type="submit" class="rounded-pill p-2 "> Reset </button></a>
      
      <form class="d-flex" role="search">
        <input class="form-control me-2" name="searching" type="search" placeholder="rechercher par nom" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Rechercher</button>
      </form>

      
    </div>
  </div>
</nav>
<!-- fin SEARCHBAR  -->