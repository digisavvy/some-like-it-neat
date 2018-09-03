
# Some Like it Neat


### A WordPress Theme Using _s, Bourbon + Neat and Theme Hook Alliance

Description
---------------

Some Like it Neat is a Minimal Starter theme that is Responsive out of the box. It uses Sass along with Bourbon Neat for help with Responsive grids. It's based on _s and is pretty rad.


What's Inside?
---------------

* [Bourbon](http://bourbon.io), [Neat](http://neat.bourbon.io), [Bitters](http://bitters.bourbon.io).

Bourbon provides a lightweight Sass library (similar to Compass).

Neat extends bourbon and provides a nice and lightweight grid framework as a base for this project. **This theme now uses [CSS Grid](https://developer.mozilla.org/en-US/docs/Web/CSS/grid) to manage layouts. I recommend that you use CSS Grid to build your layouts going forward.** Support is pretty darn good for CSS Grid. Neat has been left here and it's used primarily for breakpoint variables. If you still wish to use Neat (and it is a great framework) you may do so. But we'll be looking to remove Neat here eventually (now I have to come up with a new name for this theme).

Bitters is baked-in, too! You get some basic nifty styles out of the gate.

* Underscores (_s) based theme. There's smarter folks than me building great sh*t (http://underscores.me)

* Sass. We're using it and to update this theme you should be cozy with it or get ready to learn how to use. If you don't know Sass, you should definitely jump in. The water's fine and you'll thank me later. I accept thanks in burritos, doritos, fritos and cheetos only.

* Theme Hook Alliance — One of the things I learned to love about working with Frameworks were their hooks. Thematic and Genesis introduced me to the notion. Since them I've been using them like they're going out of style. When I set out to make my own starter theme I wanted to make something that had "just the right amount" of features for me. I knew I needed hooks. The THA project was intro'd to me by Brandon Dove, at the OCWP (http://ocwp.org) developer's day meetup. Thought it was super neat. So I bundled that hot mess right into this thing.

* Laravel Mix — Scripts that compile your sass files, minify, inject changes into a live browser session via browser-sync.  
* Built for Accessibility
* Flexnav Menu System and Hover Intent
* TGM PLugin Activation
* NPM for managing packages and dependencies
* Infinite Scroll Support for Jetpack
* Pull requests welcome...


Getting Started
---------------
There's a lot to this theme; don't be intimidated, even if you're not an _advanced-level_ developer, you got this! I'll be honest with you, I don't know how half the stuff here works, it just sorta does. =)

Bourbon and Neat are used for providing simple Sass mixins and leverages a simple grid system that let's you markup your theme how you want, while you use their math, unlike Bootstrap and Foundation, presently.

There are things you need to install before you hack away at things. There are three package managers to install: Node (which installs the NPM package manager). Each of these have dependencies that also need to be installed. Fortunately, this is all "fairly easy".


* #### Prerequisites
  * You'll need to download and install [Node](https://nodejs.org/)
  * You will need to download and install [Sass](http://sass-lang.com/install)
  * You will need also need to download, install, and configure [Composer](https://getcomposer.org/doc/00-intro.md)

* #### Getting and Installing the Theme
  * The first thing you’ll want to do is grab a copy of the theme —
**git clone git://github.com/digisavvy/some-like-it-neat.git** – or [download](http://github.com/digisavvy/some-like-it-neat) it and then rename the directory to the name of your theme or website.


* #### Install Composer and NPM Dependencies

  Once you have Node, Sass and the theme installed, the next step is simple enough.

  **_(note - you may have to run the following commands as admin or sudo)_**

  Open a command prompt/terminal and navigate to your theme's root directory. Run the following two commands:
  
  * **`composer install`** - Installs Composer and the dependencies needed for custom post meta management.

  * **`npm install`** - Installs all the necessary Gulp plugins to help with task automation such as Sass compiling and browser-sync! You'll need to run this step on each of your projects, going forward.
 
 * #### Set your project configuration in Gulpfile.js!!

_Be sure to go into webpack.mix.js and setup the project configuration variables._

  * If you plan to rename your theme files be sure to update the contents of the theme-claim.json file.


* #### Laravel Mix Tasks
Webpack or Laravel Mix, rather, 
  * `npm run watch` This command simply starts up Gulp and watches your scss, js and php filder for changes, writes them out and refreshes the browser for you.
  * `npm run bundle` This command bundles your files up into a new folder called _dist_.
  * `npm run prod` This command minifies your theme assets like your css and js files. Currently takes your _dist_ folder, zips it up, and zips it to _releases/themename.zip_.
  * `npm run rename` This is a helper that does a search replace on your theme files and replaces the name, link, author. Make sure to update theme-claim.json before running this.


Each task such as 'js', 'images' or 'browser-sync' may be started individually. Although, the only one of them you'd do that with is the 'images' task since that's not auto-optimizing at the moment.

* #### Theme Development, Minification and You
When developing your theme note that the output style.css file and production.js file are in expanded (readable) format if WP_DEBUG is set to true in wp-config.php. If WP_DEBUG is NOT set to true, then style.css and production.js are minified for you. While developing your theme, I recommend that WP_DEBUG is set to true. Just a good practice anyway.

* **A Note About Javascript Files** - If you have JS files that are not managed by NPM, you can place those files inside the assets/js/app folder. Why? Gulp runs a task that concatenates js files in that directory and checks them for errors, which is pretty nifty. You can modify Gulp task behavior to suit your tastes, of course. However, note that those scripts will load on all pages.

* **Extra Note!** If you've set WP Debug true, the concatenated file is unminified and if set to false, then the concatenated file is minified. If you don't intend to use this functionality, you should comment-out or remove the lines referring to development.js and production-min.js.

### Theme Hook Alliance
---------------

What is Theme Hook Alliance? It's a pretty rad project - https://github.com/zamoose/themehookalliance. I'm a big fan of hooks, personally. They provide a means to keep things within the theme cleaner and easier to maintain.

"_The Theme Hook Alliance is a community-driven effort to agree on a set of third-party action hooks that THA themes pledge to implement in order to give that desired consistency_."

### Infinite Scroll and Jetpack
---------------
Infinite Scroll is now supported. Requires that you have Jetpack installed and have configured the plugin to use Infinite Scroll. Additionally, you'll need to go into the Customizer to add theme support. Why? While redundant, didn't really want code running that wasn't in use... Aaand seemed like a nice use of the Customizer. If you hate it, open an issue. =)

### Bourbon and Neat
---------------
Why use these in this project? It's a philosophical thing. I've used Foundation and Bootstrap before. I like them; they're both great, great projects run by smarter people than myself. So what's the philosophical bit? To achieve the responsiveness required of various projects, I would have to tear up my HTML, input my own selector classes and what have you, in addition to changing my css. I didn't like it. I heard about Neat (http://neat.bourbon.io) and really liked their approach to a grid framework. You keep your HTML structure the way you like and all of the styling in your Sass files

### Use as a Parent Theme?
---------------
I don't see why not. ~~I haven't done it yet.~~ ( I'm using a child theme on http://alexhasnicehair.com ) But with the addition of Theme Hook Alliance, I'd say 'Some Like it Neat' would make for a good Parent Theme for your project and certainly more ideal if you're going to make significant edits (and why wouldn't you? By default it looks like pooh!).

<del>What I recommend is that you generate your child theme, setup your child theme folder, style.css file. Additionally, I think it's just easier to copy the 'library' folder from the parent and place it into the child theme.</del>
I'm gonna recommend you [have a look at this issue here] (https://github.com/digisavvy/some-like-it-neat/issues/58) for details on how to go about this.

### Folder Structure
---------------
I haven't listed out every single file here; but I have listed out the files that you'll most likely work with during
a project.

<pre style="max-height: 300px;"><code>Theme Root
├── 404.php
├── CHANGELOG.md
├── CONTRIBUTING.md
├── README.md
├── archive.php
├── assets
│   ├── css
│   │   ├── editor.css
│   │   ├── layouts
│   │   ├── style.css
│   │   └── vendor
│   ├── fonts
│   ├── img
│   ├── js
│   │   ├── app
│   │   └── vendor
│   │       ├── custom-offcanvas.js
│   │       ├── flexnav
│   │       ├── headroom
│   │       ├── hoverintent
│   │       ├── modernizr
│   │       ├── navigation.js
│   │       ├── selectivizr
│   │       └── skip-link-focus-fix.js
│   ├── maps
│   ├── styles
│   │   ├── _app.scss
│   │   ├── common
│   │   │   ├── __common-dir.scss
│   │   │   ├── _accessibility.scss
│   │   │   ├── _buttons.scss
│   │   │   ├── _forms.scss
│   │   │   ├── _grid-settings.scss
│   │   │   ├── _lists.scss
│   │   │   ├── _media.scss
│   │   │   ├── _tables.scss
│   │   │   ├── _typography.scss
│   │   │   └── _variables.scss
│   │   ├── components
│   │   │   ├── __components-dir.scss
│   │   │   ├── _buttons.scss
│   │   │   ├── _gutenberg-editor.scss
│   │   │   ├── _gutenberg.scss
│   │   │   ├── _infinite-scroll.scss
│   │   │   ├── _inputs.scss
│   │   │   └── _media.scss
│   │   ├── editor.scss
│   │   ├── layouts
│   │   │   ├── __layouts-dir.scss
│   │   │   ├── _content.scss
│   │   │   ├── _footer.scss
│   │   │   ├── _header.scss
│   │   │   ├── _navigation.scss
│   │   │   ├── _sidebar.scss
│   │   │   ├── _structure.scss
│   │   │   ├── _template-2col-l-sidebar.scss
│   │   │   ├── _template-2col-r-sidebar.scss
│   │   │   ├── _template-full-width.scss
│   │   │   ├── _template-landing-page.scss
│   │   │   └── navigation-offcanvas.scss
│   │   ├── style.scss
│   │   └── vendor
│   │       ├── __vendor-dir.scss
│   │       ├── flexnav.scss
│   │       └── headroom.scss
│   └── svg
├── attachment.php
├── comments.php
├── composer.json
├── composer.lock
├── composer.phar
├── footer.php
├── functions.php
├── gulpfile.js
├── header.php
├── index.php
├── library
│   ├── assets.php
│   ├── customizer-frontend-settings.php
│   ├── extras.php
│   ├── languages
│   ├── structure
│   │   ├── content.php
│   │   ├── footer.php
│   │   └── header.php
│   ├── theme-setup.php
│   ├── vendor.php
│   ├── vendors
│   │   ├── custom-header.php
│   │   ├── customizer
│   │   ├── extras.php
│   │   ├── jetpack.php
│   │   ├── meta.php
│   │   ├── template-tags.php
│   │   ├── tgm-plugin-activation
│   │   └── theme-hook-alliance
│   └── widgets.php
├── license.txt
├── mix-manifest.json
├── mix.js.map
├── package-lock.json
├── package.json
├── page-templates
│   ├── template-full-width.php
│   ├── template-landing-page.php
│   ├── template-left-col.php
│   ├── template-parts
│   │   ├── content-aside.php
│   │   ├── content-attachment.php
│   │   ├── content-audio.php
│   │   ├── content-chat.php
│   │   ├── content-gallery.php
│   │   ├── content-image.php
│   │   ├── content-link.php
│   │   ├── content-meta.php
│   │   ├── content-none.php
│   │   ├── content-page.php
│   │   ├── content-quote.php
│   │   ├── content-single.php
│   │   ├── content-status.php
│   │   ├── content-video.php
│   │   ├── content.php
│   │   ├── footer-landing.php
│   │   ├── header-landing.php
│   │   ├── meta-entry-footer.php
│   │   ├── meta-entry-header.php
│   │   ├── navigation-flexnav.php
│   │   └── navigation-offcanvas.php
│   └── template-right-col.php
├── page.php
├── screenshot.png
├── search.php
├── sidebar.php
├── single.php
├── singular.php
├── style.css
├── themeclaim.json
├── vendor
│   ├── autoload.php
│   ├── bin
│   ├── composer
│   ├── htmlburger
│   │   └── carbon-fields
│   ├── squizlabs
│   └── wp-coding-standards
└── webpack.mix.js

</code></pre>

How to Contribute to This Project
---------------
Your generous pull requests are welcome! Have a look at our contribution guide for details:
[Contribution Guide](https://github.com/digisavvy/some-like-it-neat/blob/master/CONTRIBUTING.md)

Road Map
---------------
* Firm up i18n for RTL and language support. Looking for contributors here
* Ensure Accessibility has been properly and thoroughly addressed

### General Credits and Thanks
---------------
A special thanks to all the folks who inspire me on a daily basis to "do more" with what I know and what I can contribute.

* Brandon Dove
* Justin Tadlock
* Emil Uzelac
* Nikhil @techvoltz
* Jon Brown
* Udit Desai
* Jeffrey Zinn
* Steve Zehngut
* Chris Lema
* Se Reed
* Natalie MacLees
* Ryan Cowles
* Nathan Tyler
* Dave Jesch
* Devin Walker
* Blair Williams
* Robert Neu
* Rachel Cherry (Roll tide, roll)
* And a <del>fuckload</del> lot more that I'm missing here.

License
---------------

This theme is based on Underscores, (C) 2012-2013 Automattic, Inc.
 - Source: http://underscores.me/
 - License: GNU GPL, Version 2 (or later)
 - License URI: license.txt

CMB2
    - Source: https://github.com/WebDevStudios/cmb2-attached-posts/blob/master/LICENSE
    - License: GNU GPL, Version 2 (or later)
    - License URI: license.txt

Flexnav, Copyright 2014 Jason Weaver.
 - Source: http://jasonweaver.name/lab/flexiblenavigation/
 - License: GNU GPL, Version 2 (or later)
 - License URI: https://github.com/

TGM Plugin Activation, Copyright 2014 Thomas Griffin Media, Inc.
 - Source: http://tgmpluginactivation.com/
 - License: GNU GPL, Version 2 (or later)
 - License URI: http://tgmpluginactivation.com/#license

Theme Hook Alliance
 - Source: https://github.com/zamoose/themehookalliance/blob/master/tha-theme-hooks.php
 - License: GNU GPL, Version 2 (or later)
 - License URI:

Bourbon
 - Source: http://bourbon.io, © 2013 thoughtbot
 - License: The MIT License
 - License URI: https://github.com/thoughtbot/bourbon/blob/master/LICENSE

Neat
 - Source: http://neat.bourbon.io, © 2013 thoughtbot
 - License: The MIT License
 - License URI: https://github.com/thoughtbot/neat/blob/master/LICENSE

Gulpjs
 - Source: http://gulpjs.com, Copyright (c) 2014 Fractal <contact@wearefractal.com>
 - License: The MIT License
 - License URI: https://github.com/gulpjs/gulp/blob/master/LICENSE

Hover Intent
 - Source: https://github.com/tristen/hoverintent
 - License: the MIT
 - License URI: license.txt
