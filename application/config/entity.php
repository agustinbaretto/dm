<?php
$config['books']['facebook_field'] = 'books';
$config['books']['lang'] = 'es_LA';
$config['books']['facebook_properties'] = 'name';
$config['books']['freebase_type'] = '/book/book';
$config['books']['freebase_properties'] = 'name';
$config['books']['strip_dictionary'] = array('libro','book','(serie)','página oficial','pagina oficial','oficial','official',' - ');

$config['movies']['facebook_field'] = 'movies';
$config['movies']['lang'] = 'en';
$config['movies']['facebook_properties'] = 'name';
$config['movies']['freebase_type'] = '/film/film';
$config['movies']['freebase_properties'] = 'name';
$config['movies']['strip_dictionary'] = array('película','pelicula','movie','página oficial','pagina oficial','oficial','official','trilogía','trilogia','trilogy',' - ');

$config['director']['freebase_type'] = '/film/director';
$config['director']['freebase_properties'] = 'name';

$config['author']['freebase_type'] = '/book/author';
$config['author']['freebase_properties'] = 'name';