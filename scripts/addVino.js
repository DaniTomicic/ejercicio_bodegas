// enviarVino: realiza la petición a la API y devuelve true/false según éxito.
// Correcciones comentadas: antes no se devolvía nada, así que el caller no podía saber
// si la operación había tenido éxito. Además se maneja el error sin hacer alert directo.
async function enviarVino(vino) {
    try{
        const request = await fetch("api/annadirVino.php",{
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(vino)
        });

        if(!request.ok){
            // Leer respuesta del servidor si la hay para depuración
            const text = await request.text();
            console.error('Error en la respuesta del servidor:', request.status, text);
            return false;
        }

        const json = await request.json().catch(()=>null);
        return json ? (json.success === true) : true

    }catch(error){
        // No usamos alert aquí para no interrumpir UX; retornamos false para que el caller lo maneje.
        console.error('Fetch error:', error);
        return false;
    }
}

// validarCampos: evita errores con valores no-string (como números)
function validarCampos(input) {
    if (input === null || input === undefined) return false;
    const s = (typeof input === 'string') ? input.trim() : String(input).trim();
    return s.length > 0;
}

// crearVino: async para poder await enviarVino y mostrar feedback correcto.
async function crearVino(event){
    event.preventDefault();

    const form = document.querySelector("form");
    const campos = form.querySelectorAll("input, textarea");

    for(let input of campos){
        if(!validarCampos(input.value)){
            alert("El campo " + input.name + " no cumple los requisitos");
            return;
        }
    }

    const vino = {
        idBodega: form.querySelector("#id-bodega").value,
        nombre: form.querySelector("#nombre-vino").value,
        tipo: form.querySelector("#tipo-vino").value,
        anno: form.querySelector("#anno-vino").value,
        alcohol: form.querySelector("#alcohol-vino").value,
        descripcion: form.querySelector("#desc-vino").value,
    };

    // Corregimos la comprobación previa (antes se llamaba trim sobre valores no-string)
    if (Object.values(vino).some(val => val === null || val === undefined || (typeof val === 'string' && val.trim() === ''))) return;

    // Llamar a la API y esperar resultado
    const ok = await enviarVino(vino);

    // Obtener o crear el span donde mostraremos el mensaje
    let span = form.querySelector("span");
    if(!span){
        span = document.createElement('span');
        span.className = 'span-message';
        const fa = form.querySelector('.form-actions');
        if(fa) fa.appendChild(span);
        else form.appendChild(span);
    }

    if(ok){
        // Aplicamos la clase que tiene la animación CSS de 3.5s
        span.className = 'span-message span-correcto';
        span.textContent = 'Vino creado correctamente!';
    }else{
        span.className = 'span-message span-error';
        span.textContent = 'No se ha podido insertar el vino';
    }
    // console.log(vino, 'resultado:', ok);
}

document.addEventListener("DOMContentLoaded", ()=>{
    // Se añade el eventListener al submit del form
    const form = document.querySelector("form");
    if(form) form.addEventListener("submit", crearVino);

    // Comentario: el form no tiene action porque la petición se hace desde JS hacia
    // la API `api/annadirVino.php`.
});
