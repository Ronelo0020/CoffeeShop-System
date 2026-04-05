<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// --- AUTHENTICATION ---
$routes->get('/', 'Auth::index');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/loginProcess', 'Auth::loginProcess');
$routes->post('auth/store', 'Auth::store');
$routes->get('auth/logout', 'Auth::logout');

// --- DASHBOARD ---
$routes->get('dashboard', 'Dashboard::index');

// --- PRODUCT CRUD ---
$routes->get('products', 'Products::index');
$routes->get('products/add', 'Products::add');
$routes->post('products/store', 'Products::store');
$routes->get('products/edit/(:num)', 'Products::edit/$1'); // Edit View
$routes->post('products/update/(:num)', 'Products::update/$1'); // Update Action
$routes->get('products/delete/(:num)', 'Products::delete/$1');

// --- POS & SALES ---
$routes->get('pos', 'Pos::index');
$routes->post('pos/save_order', 'Pos::save_order'); 
$routes->get('sales', 'Sales::index');

// Dugang ini para sa Manage Staff
$routes->get('auth/manage', 'Auth::manage');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/store', 'Auth::store');
$routes->get('auth/edit/(:num)', 'Auth::edit/$1');
$routes->post('auth/update/(:num)', 'Auth::update/$1');
$routes->get('auth/delete/(:num)', 'Auth::delete/$1');