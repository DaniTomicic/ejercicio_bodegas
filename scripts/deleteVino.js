console.log("Linked document deleteVino.js");

async function eliminarVinoAsync(idVino) {
    console.log("Entra en la funcion eliminarVinoAsync con id: " + idVino);
    const idBodega = document.getElementById("idBodega").value;

    // Como existe ya un 
    try{
        const request = await fetch("api/borrarVino.php",{
            method: "DELETE",
            headers: {
                "Content-Type":"Application/json"
            },
            body: JSON.stringify({
                idBodega: idBodega,
                idVino: idVino,
            })
        });
        if(!request.ok){
            const res = await request.text();
            console.log(res + "\n" + request.status);
        }
        // location.reload() hace refresh sin refrescar la cahé por lo que algunos datos residuales pueden quedar en la view
        location.reload(true)

    }catch(error){
        console.log("FETCH ERR: " + error);

    }
    
}
document.addEventListener("DOMContentLoaded", ()=>{
    //Obtengo el querySelectorAll por la clase que devuelve una nodeList y los itero como un array
    document.querySelectorAll(".eliminar-vino").forEach(btn=>{
        // Como guardo en el data-id el id del vino, creo una variable id que es el valor del dataset y se lo paso a la funcion de eliminarVinoAsyn en caso de darle click
        btn.addEventListener("click", ()=>{
            const id = btn.dataset.id;
            eliminarVinoAsync(id);
        })
    });

})