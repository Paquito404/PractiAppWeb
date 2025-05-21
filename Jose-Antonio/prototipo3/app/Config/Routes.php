<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ------------------------- Login ------------------------- //

$routes->get('/', 'Home::index');
$routes->post('login', 'Home::login');
$routes->get('logout', 'Home::logout');

// -------------------------------------------------------- //

//-------------------------- Contenido ------------------------ //

$routes->get('alumno', 'Home::alumno');
$routes->get('maestro', 'Home::maestro');
$routes->get('carga/(:any)', 'Home::carga/$1');
$routes->get('/verFila/(:any)', 'Home::verFila/$1');
$routes->get('/revision/(:num)', 'Home::revision/$1');
$routes->post('/fase/(:num)', 'Home::fase/$1');

// -------------------------------------------------------- //

// -------------------- CRUD Practicas -------------------- //

$routes->post('escuela', 'Home::guardar');
$routes->get('/vista/(:num)', 'Home::vista/$1');
$routes->get('/editar/(:num)', 'Home::editar/$1');
$routes->post('/actualizar/(:num)', 'Home::actualizar/$1');
$routes->delete('/eliminar/(:num)', 'Home::eliminar/$1');

// -------------------------------------------------------- //

// -------------------- CRUD Maestros --------------------- //

$routes->post('registroM', 'Home::guardarM');
$routes->get('/obtenerM/(:num)', 'Home::ObtenerM/$1');

// -------------------------------------------------------- //