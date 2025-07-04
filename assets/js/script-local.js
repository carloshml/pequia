/**
* Decimal adjustment of a number.
*  made by: Mozilla Foundation
*  find on: https://developer.mozilla.org/pt-BR/docs/Web/JavaScript/Reference/Global_Objects/Math/ceil
* @since   18/07/2018
* @param	{String}	type	The type of adjustment.
* @param	{Number}	value	The number.
* @param	{Integer}	exp		The exponent (the 10 logarithm of the adjustment base).
* @returns	{Number}			The adjusted value.
*/
function decimalAdjust(type, value, exp) {
  // If the exp is undefined or zero...
  if (typeof exp === 'undefined' || +exp === 0) {
    return Arredondador[type](value);
  }
  value = +value;
  exp = +exp;
  // If the value is not a number or the exp is not an integer...
  if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
    return NaN;
  }
  // Shift
  value = value.toString().split('e');
  value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
  // Shift back
  value = value.toString().split('e');
  return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
}

// Decimal floor
function floor10(value, exp) {
  return decimalAdjust('floor', value, exp);
}

// Decimal ceil
function ceil10(value, exp) {
  return decimalAdjust('ceil', value, exp);
}
// Decimal trunc
function trunc10(value, exp) {
  return decimalAdjust('trunc', value, exp);
}




function nav() {
  let naveg = '';
  naveg += '  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">';
  naveg += ' <div class="container" >';
  naveg += '  <a class="navbar-brand js-scroll-trigger" href="../index.php">Pequiá <span id="usuario_nome" ></span> </a>';
  naveg += '   <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">';
  naveg += '   Menu';
  naveg += '       <i class="fas fa-bars"></i>';
  naveg += '   </button>';
  naveg += '    <div class="collapse navbar-collapse" id="navbarResponsive">';
  naveg += '<ul class="navbar-nav ml-auto"> ';


  if (localStorage.getItem('tipo') && localStorage.getItem('tipo') != 'CLIENTE') {
    naveg += '<li class="nav-item mx-0 mx-lg-1">';
    naveg += '  <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="produto-detalhe.php">';
    naveg += '    Publicar'
    naveg += '   </a>';
    naveg += '</li>';
  }

  if (localStorage.getItem('tipo') && localStorage.getItem('tipo') === 'CLIENTE') {
    naveg += '<li class="nav-item mx-0 mx-lg-1">';
    naveg += '    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href = "loja.php" >';
    naveg += '       <i class="fas fa-home"></i> Loja';
    naveg += '    </a >';
    naveg += '</li > ';
  } else {
    naveg += '<li class="nav-item mx-0 mx-lg-1">';
    naveg += '    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="home.php" >';
    naveg += '      <i class="fas fa-home"></i> home';
    naveg += '    </a >';
    naveg += '</li > ';
  }

  if (localStorage.getItem('usuario_nome')) {
    naveg += ' <li class="nav-item mx-0 mx-lg-1">';
    naveg += '     <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"  onclick="sair()" >';
    naveg += '           <i class="fas fa-sign-out-alt"></i> sair';
    naveg += '      </a >';
    naveg += ' </li > ';
  } else {
    naveg += ' <li class="nav-item mx-0 mx-lg-1">';
    naveg += ' <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" aria-current="page" href="#" role="button" data-toggle="modal" data-target="#login-modal">';
    naveg += '     Entrar';
    naveg += ' </a>';
    naveg += '</li>';
  }
  naveg += '</ul>';
  naveg += '</div>';
  naveg += '</div>';
  naveg += '</nav > ';
  naveg += '<div style="padding-top: 10em;"> <div>';

  return naveg;
}



function sair() {
  localStorage.setItem('id_usuario', '');
  localStorage.setItem('usuario_login', '');
  localStorage.setItem('email', '');
  localStorage.setItem('usuario_nome', '');
  localStorage.setItem('tipo', '');
  window.location.href = `${obterAPI()}index.php`;
}