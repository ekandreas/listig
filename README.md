# Listig
Another List Manager in WordPress.
Editorial plugin to manage custom post lists.

## WIP
Version *0.0.6*

This plugin is not yet released and will not be working in production environment.

As development environment we use another repo at [Github](https://github.com/ekandreas/listig.app).

## Requirements
* PHP ^7.0 
* WordPress ^4.7

## Hooks and filters
* `listig/post` when transforming the post data to a Listig post. Use this to override specific settings for your post type.
* `listig/strip_tags` if you don't wont Listig to strip tags.

## Things to consider:
Composer is just used as a Packagist declaration. 
The plugin requirements for the backend is just WordPress from version 4.7.

Autoload will not be provided via Composer 
as the plugin will be published at the official WordPress plugin repository as downloadable plugin.

## Goal
Create a WordPress plugin for post list managing based on fun techniques as: 
* Laravel Mix with WebPack for JS-compilations
* Vue JS for stable frontend framework
* Bulma for easy design modules
* WordPress REST API as backend front

We are (in this project) aiming for modern frontend / backend communication via REST API.
Therefore no backend dependencies except for standard WordPress.

## Contact
andreas@elseif.se

## License
[MIT](https://opensource.org/licenses/MIT)