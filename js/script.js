// ****************************Utilisateurs*******************

// get projects id and make it in the edit form
document.querySelectorAll(".edit-pro").forEach(icon =>{
    icon.addEventListener("click",()=>{
        let proIdTag = icon.parentNode.parentNode.querySelector(".project-title");
        let proId = proIdTag.getAttribute("data-id");
        document.querySelector(".putId").value = proId;
    })
})

