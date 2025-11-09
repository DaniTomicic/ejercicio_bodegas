
function buscarPorTexto(){
    const textoABuscar = document.getElementById("filter-vinos").value.trim().toLowerCase();    
    const vinos = JSON.parse(localStorage.getItem("vinos"));
    // Obtiene el nodo ul y lo limpia
    const ul = document.getElementById("vinos-list");
    ul.innerHTML = "";

    if(vinos.length > 0){
        const coindicentes = vinos.filter(v => v.nombre.toLowerCase().includes(textoABuscar));
        
        for(const vino of coindicentes){
            // console.log("llega al for")
            crearLista(vino);
        }
        
        if (coindicentes.length === 0) {
            const li = document.createElement("li");
            li.textContent = "No se encontraron vinos que coincidan.";
            li.className = "list-item list-empty";
            ul.appendChild(li);
        }

    }
}
document.addEventListener("DOMContentLoaded", ()=>{
    // Debería tener ya el array de vinos desde fecth o localStorage, añadiré la funcionalidad de búsqueda primero con LocSt. y dps con el await para no estresar al server
    document.getElementById("filter-vinos").addEventListener("input", buscarPorTexto);
});