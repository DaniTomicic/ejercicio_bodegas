async function guardar(vino) {
    try{
        // mandar POST o PUT por applicatin/json en el body el vino y luego hacer la omparacion desde la funcion de BD con el id del mismo
        const request = await fetch("api/editVino.php",{
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(vino)
        });
        console.log("Hago la peticion al back");    
        if(!request.ok){
            const text = await request.text();
            console.log(text);
        }
        console.log(request);
        const json = await request.json().catch(()=> null);
        return json ? (json.success === true) : true;
    }catch(error){
        console.log(error);
    }       
}
function validarCampos(input){
    return input.length > 0 && input != null;
}

async function editVino(event) {
    event.preventDefault();
    // obtener datos de campos
    const form = document.querySelector("form");
    const campos = form.querySelectorAll("input", "textarea");
    
    for(let input of campos){
        if(!validarCampos(input.value)){
            alert("el campo " + input.name + " no es válido");
            return;
        }
    }
    const vino = {
        idVino: form.querySelector("#id-vino").value,
        idBodega: form.querySelector("#id-bodega").value,
        nombre: form.querySelector("#nombre-vino").value,
        tipo: form.querySelector("#tipo-vino").value,
        anio: form.querySelector("#anno-vino").value,
        alcohol: form.querySelector("#alcohol-vino").value,
        descripcion: form.querySelector("#desc-vino").value,
    };
    
    const ok = await guardar(vino);
    let span = form.querySelector("span");
    if(!span){
        span = document.createElement("span");
        span.className = 'span-message';
        const fa = form.querySelector('.form-actions');
        if(fa) fa.appendChild(span);
        else form.appendChild(span);
    }
    if(ok){
        span.className = 'span-message span-correcto';
        span.textContent = 'Vino actualizado correctamente!';
    }else{
        span.className = 'span-message span-error';
        span.textContent = 'Ha habido un error al actualizar el Vino!';
    }
}
document.addEventListener("DOMContentLoaded", () =>{
    document.getElementById("btn-guardar-vino").addEventListener("click", editVino)
})