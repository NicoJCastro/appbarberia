let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

document.addEventListener('DOMContentLoaded', () => {
    iniciarApp();
});

function iniciarApp() {
    mostrarSeccion(); // Muestra la seccion de acuerdo al paso
    tabs(); // Agrega la funcionalidad de los tabs
    botonesPaginador(); // Agrega la funcionalidad de los botones de paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI(); // Consulta la API en el backend de PHP
}

function mostrarSeccion() {
    // Ocultar la seccion anterior
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }

    // Seleccionar la seccion con el paso
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // Eliminar la clase de actual en el tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }

    // Mostrar el paso actual en el tab
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual'); 

}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');    
    botones.forEach(boton => {
        boton.addEventListener('click', (e) => {
           paso = parseInt(e.target.dataset.paso);
           mostrarSeccion();
           botonesPaginador();
        });
    });
}

function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if (paso === 1) {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if (paso === 3) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', () => {
        if (paso >= pasoFinal) return;
        paso++;
        botonesPaginador();
    });
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', () => {
        if (paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
    });
}

async function consultarAPI() {
    try {
        const url = 'http://localhost/appbarberia/api/servicios'
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    }
    catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    servicios.forEach(servicio => {
        const { id, nombre, precio } = servicio;
        
        // DOM Scripting
        const nombreServicio = document.createElement('P'); // P parrafo 
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$ ${precio}`;

        const divServicio = document.createElement('DIV');
        divServicio.classList.add('servicio');
        divServicio.dataset.idServicio = id;
        
        divServicio.appendChild(nombreServicio);
        divServicio.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(divServicio); // Agregar al HTML el servicio creado por medio del id= servicios
    });
}