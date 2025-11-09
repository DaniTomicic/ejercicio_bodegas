async function obtenerVinos(){
    try{
        const response = await fetch("/ejercicio_bodegas/api/obtenerVinos.php",{
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            },
        })
        let vinos = null;
        if(response.ok){
            const result = await response.json();
            vinos = result.data;
        }

        return vinos ?? null;

    }catch(error){
        console.log(error);
        return null;
    }
}
    function guardarEnCache(vino){
        const arrayVinos = JSON.parse(localStorage.getItem("vinos")) || [];
        const yaExiste = arrayVinos.some(v => v.id_vino == vino.id_vino);

        if(!yaExiste) arrayVinos.push(vino);
        localStorage.setItem("vinos", JSON.stringify(arrayVinos));
    }
function crearLista(vino){
    const ul = document.getElementById("vinos-list");
    const li = document.createElement("li");
    const div = document.createElement("div");
    const div2 = document.createElement("div");
    const spanAnio = document.createElement("span");
    const spanAlcohol = document.createElement("span");
    const strong = document.createElement("strong");
    const span = document.createElement("span");

    li.className = 'list-item'; 
    div.className = 'list-item-main';
    div2.className = 'list-item-meta';
    spanAnio.className = 'vino-anio';
    spanAlcohol.className = 'vino-alcohol';
    strong.className = 'vino-nombre';
    span.className = 'vino-tipo muted';
    span.textContent = vino.tipo;
    strong.textContent = vino.nombre;
    spanAnio.textContent = "Año: " + vino.anio + " - ";
    spanAlcohol.textContent = "Concentración: " + vino.alcohol + "%";
    // Al hacer append chil hay que llamar el mismo numero de ver que se quiera concatenar algo
    div2.appendChild(spanAnio); div2.appendChild(spanAlcohol);
    div.appendChild(strong); div.appendChild(span);
    li.appendChild(div); li.appendChild(div2);
    ul.appendChild(li);
}
document.addEventListener("DOMContentLoaded",async ()=>{
    const vinosCache = JSON.parse(localStorage.getItem("vinos"));
    if(vinosCache){
        for (const vino of vinosCache) {
            console.log("Entra en loop de cahce");
            crearLista(vino);
        }
        return;
    }
    const vinos = await obtenerVinos(); //Se espera una PROMISE

    if(vinos && vinos.length > 0){
        // Si hay vinos obtendré del document el nodo padre y con innferHTML o textContent pondré esos dartos
        for(const vino of vinos){

            crearLista(vino); 
            guardarEnCache(vino);
        }
        // Se podria guardar en LocalStorage para no hacer tanta requesta backend
    }else{
        alert("no hay vinos que ver")
    } 
});