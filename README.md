# Listig
Another List Manager in WordPress.
Editorial plugin to manage custom post lists.

The plugin is published at the official [WordPress plugin repository](https://wordpress.org/plugins/listig/) for download.

## Work In Progress
This is a plugin in beta phase. A lot of work in progress.
As development environment we use another repo at [Github](https://github.com/ekandreas/listig.app).

## Requirements
* PHP ^7.0 
* WordPress ^4.7

## Usage with shortcodes
You can render your list with the following shortcodes:

* `[listig]`, takes all its content and repeats it for every post item in your list.
* `[listig-headline]`, shows the current post items headline.
* `[listig-excerpt]`, shows the current post items text.
* `[listig-url]`, gives the url to the post item edited. Takes one argument `target`, eg: `[listig-url target="_blank"]` will render a hyperlink that opens in a new tab. 
* `[listig-image]`, renders an image from the post item. You have the same arguments as to wp_get_attachment_image. Eg: `[listig-image size="medium"]` will render an image with the defined medium size.

Here is an example from a post content to render a complete list with id=236:

```
[listig id="236"]

[listig-headline]

[listig-image]

[listig-excerpt]

[listig-url]Read more![/listig-url]

[/listig]
```

Then you can format the shortcodes, eg set the headline to H2 and the read more link to italic.

![shortcode example](https://raw.githubusercontent.com/ekandreas/listig/master/assets/img/example-page-with-shortcodes.png "Shortcode example page with Twenty Seventeen")

## Usage in templates
The global function `listig` accepts the ID of the list you want to loop. The ID is printed in the list settings (the gear icon).

`listig` returns an array with posts of properties; headline, excerpt, imageId and imageUrl.

A simple example to render the output from a list:

```php
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
