let paso=1;const pasoInicial=1,pasoFinal=3;function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI()}function mostrarSeccion(){const t=document.querySelector(".mostrar");t&&t.classList.remove("mostrar");const e=`#paso-${paso}`;document.querySelector(e).classList.add("mostrar");const o=document.querySelector(".actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach((t=>{t.addEventListener("click",(t=>{paso=parseInt(t.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))}))}function botonesPaginador(){const t=document.querySelector("#anterior"),e=document.querySelector("#siguiente");1===paso?(t.classList.add("ocultar"),e.classList.remove("ocultar")):3===paso?(t.classList.remove("ocultar"),e.classList.add("ocultar")):(t.classList.remove("ocultar"),e.classList.remove("ocultar")),mostrarSeccion()}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(()=>{paso>=3||(paso++,botonesPaginador())}))}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(()=>{paso<=1||(paso--,botonesPaginador())}))}async function consultarAPI(){try{const t="http://localhost/appbarberia/api/servicios",e=await fetch(t);mostrarServicios(await e.json())}catch(t){console.log(t)}}function mostrarServicios(t){t.forEach((t=>{const{id:e,nombre:o,precio:a}=t,s=document.createElement("P");s.classList.add("nombre-servicio"),s.textContent=o;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent=`$ ${a}`;const n=document.createElement("DIV");n.classList.add("servicio"),n.dataset.idServicio=e,n.appendChild(s),n.appendChild(c),document.querySelector("#servicios").appendChild(n)}))}document.addEventListener("DOMContentLoaded",(()=>{iniciarApp()}));