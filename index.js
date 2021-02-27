let fileBtn = document.querySelector(".edit-btn");
let filePic = document.querySelector("#product-pic-change");
let fileSave = document.querySelector(".edit-btn-save");

fileBtn.addEventListener("click",(e)=>{
    e.preventDefault();
    filePic.click();

    fileBtn.style.visibility = "hidden";
    fileBtn.style.display = "none";
    fileSave.style.visibility = "visible";
    fileSave.style.display = "block";
})