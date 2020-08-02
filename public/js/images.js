window.onload = () =>{
    //gestion des buttons supprimer
    let links = document.querySelectorAll("[data-delete]")
    for (link of links){
        link.addEventListener("click", function(e){
            e.preventDefault()
            if(confirm("Voulez-vous réellement supprimer cette image ?")){
                fetch(this.getAttribute("hrf"), {
                    method : "DELETE",
                    headers : {
                        "X-Requested-With" : "XMLHttpRequest",
                        "Content-Type": "application/json"
                    },

                    body : JSON.stringify({"_token": this.dataset.token})
                }).then()
            }
        })
    }

}