let burger = document.querySelector("#burger");
            //dans document querySelector va ciblé l'id 

let spantop = document.querySelector("#spantop");
let spanmiddle = document.querySelector("#spanmiddle");
let spanbottom = document.querySelector("#spanbottom");
// let idmenudur = document.querySelector("#menudur");

let menuresponsive = document.querySelector("#menuresponsive");

let ecart =  document.querySelector("#ecart");

let formulaire =  document.querySelector("#formulaire");


console.log(burger.className);//ressort dans la console les clsses associés




function menu(){

    // console.log('ta cliké')


    if (burger.className === "burger"){

    spantop.style.transform = "translateY(10px) rotate(45deg)";
    spanbottom.style.transform = "translateY(-10px) rotate(-45deg)";
    spanmiddle.style.opacity = "0";

    // spantop.style.transform = "translateY(20px) rotate(45deg)";
    // spanbottom.style.transform = "translateY(-25px) rotate(-45deg)";

    burger.className= "burger active ";
    menuresponsive.style.marginTop = "0%"
    menuresponsive.style.marginBottom = "0%"
    menuresponsive.style.opacity = "1"
    // menuresponsive.style.position = "absolute"
    
    
   
    //

    }else{

        spantop.style.transform = "translateY(0) rotate(0)";
        spanbottom.style.transform = "translateY(0) rotate(0)";
        spanmiddle.style.opacity = "1";
        burger.className= "burger";
        menuresponsive.style.marginTop = "-900px"
        menuresponsive.style.marginBottom = "100px"
        menuresponsive.style.opacity = "0"
        // menuresponsive.style.backgroundColor = "transparent"

        
        
        // menuresponsive.style.display = "none"
        

        // menuresponsive.style.display = "none"



    }


}


 burger.addEventListener("click",menu);


// menudur.addEventListener('mouseover', function(){menudur.style.fontWeight ='bold'});



/*
function survol(){
    if(onmouseover === "menudur"){
        menudur.style.fontSize = "150px";
    


    }else{
    menudur.style.fontSize = "50px";
    }
}

menudur.addEventListener("onmouseover",survol);*/