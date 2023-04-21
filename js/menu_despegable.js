const iconoMenu = document.querySelector('#icono-menu'),
  menu = document.querySelector('#menu'),
  contenido = document.querySelector('.contenido');

iconoMenu.addEventListener('click', (e) => {

  // Alternamos estilos para el menú y body
  menu.classList.toggle('active');
 
  // Movemos el contenido hacia la derecha al desplegar el menú
  contenido.classList.toggle('mover-derecha');

  // Alternamos su atributo 'src' para el ícono del menú
  const rutaActual = e.target.getAttribute('src');

  if (rutaActual == '../img/icono2.png') {
    e.target.setAttribute('src', '../img/icono.png');
  } else {
    e.target.setAttribute('src', '../img/icono2.png');
  }
});