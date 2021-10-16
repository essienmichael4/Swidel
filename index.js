let toggleStatus = false;
let overlay = document.querySelector(".bringCart");
let btnEdit = [ ...document.querySelectorAll(".edit-btn")];

btnEdit.forEach(button=>{
    button.addEventListener("click", e=>{
        e.preventDefault();

        let id = e.target.id;
        alert(id);
        let filePic = document.querySelector(`#product-pic-change${id}`).id;
        let fileSave = document.querySelector(`#save${id}`);

        

        // alert(fileSave.id);
    })
})

// let theParent = document.querySelector("#parent");

// theParent.addEventListener("click", (e)=>{
//     e.target.preventDefault();

//     if(e.target !== e.currentTarget){
        
//         let id = e.target.id; 

//         alert(id);

//         // let idValue = document.querySelector(".idvalue").value();
//         let filePic = document.querySelector(`#product-pic-change${id}`);
//         let fileSave = document.querySelector(`#save${id}`);
            
            
//         filePic.click();
        
//         id.style.visibility = "hidden";
//         id.style.display = "none";
//         fileSave.style.visibility = "visible";
//         fileSave.style.display = "block";
//     }
//     e.stopPropagation();
// });

let changePic = e =>{
    let id = e.target.id; 
    e.target.preventDefault();

    alert(id);

}
    



function bringCart(){
    let cartOverlay = document.querySelector(".addedCartOverlay");
    let cartDisplay = document.querySelector(".cartDisplay");

    if(toggleStatus === false){
        cartOverlay.style.visibility = "visible";
        cartDisplay.style.transform = "translateX(0)";
        cartOverlay.style.transform = "translateX(0)";

        toggleStatus= true;
    }else{
        cartOverlay.style.visibility = "hidden";
        cartDisplay.style.transform = "translateX(100%)";
        // cartOverlay.style.transform = "translateX(100%)";
        toggleStatus= false;
    }
}