let paso=1;const pasoInicial=1,pasoFinal=3,cita={nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t=`#paso-${paso}`;document.querySelector(t).classList.add("mostrar");const o=document.querySelector(".actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach((e=>{e.addEventListener("click",(e=>{paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))}))}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar")):3===paso?(e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumen()):(e.classList.remove("ocultar"),t.classList.remove("ocultar")),mostrarSeccion()}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(()=>{paso>=3||(paso++,botonesPaginador())}))}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(()=>{paso<=1||(paso--,botonesPaginador())}))}async function consultarAPI(){try{const e="http://localhost/appbarberia/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach((e=>{const{id:t,nombre:o,precio:n}=e,a=document.createElement("P");a.classList.add("nombre-servicio"),a.textContent=o;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent=`$ ${n}`;const r=document.createElement("DIV");r.classList.add("servicio"),r.dataset.idServicio=t,r.onclick=function(){seleccionarServicio(e)},r.appendChild(a),r.appendChild(c),document.querySelector("#servicios").appendChild(r)}))}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,n=document.querySelector(`[data-id-servicio="${t}"]`);o.some((e=>e.id===t))?(cita.servicios=o.filter((e=>e.id!==t)),n.classList.remove("seleccionado")):(cita.servicios=[...o,e],n.classList.add("seleccionado"))}function nombreCliente(){cita.nombre=document.querySelector("#nombre").value}function seleccionarFecha(){const e=document.querySelector("#fecha");e.addEventListener("input",(t=>{const o=new Date(t.target.value).getUTCDay();[0,6].includes(o)?(e.value="",mostrarAlerta("No se permiten citas los fines de semana","error","#paso-2 p")):cita.fecha=e.value}))}function seleccionarHora(){const e=document.querySelector("#hora");e.addEventListener("input",(t=>{const o=t.target.value,n=o.split(":");n[0]<9||n[0]>18?(e.value="",mostrarAlerta("Hora no válida","error","#paso-2 p")):cita.hora=o}))}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("Faltan datos de servicios, hora y fecha","error",".contenido-resumen",!1);const{nombre:t,fecha:o,hora:n,servicios:a}=cita,c=document.createElement("H3");c.textContent="Resumen de Servicios",e.appendChild(c),a.forEach((t=>{const{id:o,precio:n,nombre:a}=t,c=document.createElement("DIV");c.classList.add("contenedor-servicio");const r=document.createElement("P");r.textContent=a;const s=document.createElement("P");s.innerHTML=`<span>Precio:</span> $${n}`,c.appendChild(r),c.appendChild(s),e.appendChild(c)}));const r=document.createElement("H3");r.textContent="Resumen de Cita",e.appendChild(r);const s=document.createElement("P");s.innerHTML=`<span>Nombre:</span> ${t}`;const i=new Date(o),d=i.getMonth(),l=i.getDate()+2,u=i.getFullYear(),m=new Date(Date.UTC(u,d,l)).toLocaleDateString("es-AR",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),p=document.createElement("P");p.innerHTML=`<span>Fecha:</span> ${m}`;const v=document.createElement("P");v.innerHTML=`<span>Hora:</span> ${n} Horas`,e.appendChild(s),e.appendChild(p),e.appendChild(v)}function mostrarAlerta(e,t,o,n=!0){const a=document.querySelector(".alerta");a&&a.remove();const c=document.createElement("DIV");c.textContent=e,c.classList.add("alerta"),c.classList.add(t);document.querySelector(o).appendChild(c),n&&setTimeout((()=>{c.remove()}),3e3)}document.addEventListener("DOMContentLoaded",(()=>{iniciarApp()}));