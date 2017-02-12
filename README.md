# Listig
Another List Manager in WordPress.
Editorial plugin to manage custom post lists.

## WIP
Version *0.1*

This is a plugin in beta phase. A lot of work in progress.

As development environment we use another repo at [Github](https://github.com/ekandreas/listig.app).

## Requirements
* PHP ^7.0 
* WordPress ^4.7

## Usage in templates
The global function `listig` accepts the ID of the list you want to loop. The ID is printed in the list settings (the gear icon).

`listig` returns an array with posts of properties; headline, excerpt, imageId and imageUrl.

A simple example to render the output from a list:
```
$posts = listig(236);
foreach ($posts as $post) {
    ?>
    <img src="<?= $post->imageUrl ?>"/>
    <h2>
        <?= $post->headline ?>
    </h2>
    <p>
        <?= $post->excerpt ?>
    </p>
    <?php
}
```

## Hooks and filters
* `listig/post` when transforming the post data to a Listig post. Use this to override specific settings for your post type.
* `listig/strip_tags` if you don't wont Listig to strip tags.

## Things to consider:
This plugin is using the WP REST API but with it's own endpoints. 
Every call is authenticated with nonce and X-WP-Nonce to the header.

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