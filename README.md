
# Some Like it Neat

### A WordPress Theme Using _s, Bourbon + Neat and Theme Hook Alliance

Description
---------------

Some Like it Neat is a Minimal Starter theme that is Responsive out of the box. It uses Sass along with Bourbon Neat for help with Responsive grids. It's based on _s and is pretty rad.


Donate (or submit a pull request)
---------------
<a href='https://pledgie.com/campaigns/27978'><img alt='Click here to lend your support to: Some Like it Neat, a WordPress Starter Theme and make a donation at pledgie.com !' src='https://pledgie.com/campaigns/27978.png?skin_name=chrome' border='0' ></a>

What's Inside?
---------------

* Bourbon (http://bourbon.io), Neat (http://neat.bourbon.io), Bitters (http://bitters.bourbon.io) and Refills (http://refills.bourbon.io) — Bourbon provides a lightweight Sass library (similar to Compass).

Neat extends bourbon and provides a nice and lightweight grid framework as a base for this project. Refills and Bitters provide additional styling and UI elements. I suggest you visit each of these projects to learn more and how to use them.

* Underscores (_s) based theme. There's smarter folks than me building great sh*t (http://underscores.me)

* Sass. We're using it and to update this theme you should be cozy with it or get ready to learn how to use. If you don't know Sass, you should definitely jump in. The water's fine and you'll thank me later. I accept thanks in burritos, doritos, fritos and cheetos only.

* Theme Hook Alliance — One of the things I learned to love about working with Frameworks were their hooks. Thematic and Genesis introduced me to the notion. Since them I've been using them like they're going out of style. When I set out to make my own starter theme I wanted to make something that had "just the right amount" of features for me. I knew I needed hooks. The THA project was intro'd to me by Brandon Dove, at the OCWP (http://ocwp.org) developer's day meetup. Thought it was super neat. So I bundled that hot mess right into this thing.

* Gulpjs Task Automation — This has been a biggy! Lots of work done and yet to-do. Your gulpjs file will help automate nifty
tasks such as autoprefixing, compiling and minifying Sass files; cleaning up your theme directory and even packaging/zipping
your theme! Cool. Right?

* RTL Support via the most excellent bi-app-sass project
* Built for Accessibility
* Flexnav Menu System and Hover Intent
* TGM PLugin Activation
* Bower. It's in there

* Pull requests welcome...


Getting Started
---------------

* #### Prerequisites
  * You'll need to download and install [Node](http://nodejs.com)
  * You will also need to download and install [Sass](http://sass-lang.com/install)

* #### Getting and Installing the Theme
  * The first thing you’ll want to do is grab a copy of the theme —
**git clone git://github.com/digisavvy/some-like-it-neat.git** – or [download](http://github.com/digisavvy/some-like-it-neat) it and then rename the directory to the name of your theme or website.

* #### Generating your styles
  * In pre 1.1.11 builds of Some Like it Neat, Style.scss would process/compile all of your changes to the various Sass files. This has changed in 1.1.11. We have added rtl
  support using a set of mixins from the Bi-App-Sass [view](http://anasnakawa.github.io/bi-app-sass/) project which helps us generate styles for RTL configurations. All LTR styles are output to style.css and RTL styles are output to rtl.css.

* #### Install Gulpjs and Plugins
  Once you have Node, Sass and the theme installed, the next step is simple enough.
  * Open a command prompt/terminal and navigate to your theme's root directory and run this command: **npm install**
 _(note - you may have to run this command as admin or sudo)_

* #### Gulp Tasks
There are a couple of tasks built into Some Like it Neat to help get you going.
  * **gulp** This command simply starts up Gulp and watches your scss, js and php filder for changes, writes them out and refreshes the browser for you.
  * **gulp build** This command removes unneccessary files and packs up the required files into a nice and neat, installable, zip package. Honestly, this is here because I was uploading my theme to the WP.org uploader so many times... Epitome of the laze.

Each task such as 'js', 'images' or 'browser-sync' may be started individually. Although, the only one of them you'd do that with is the 'images' task since that's not auto-optimizing at the moment.

### Theme Hook Alliance
---------------

What is Theme Hook Alliance? It's a pretty rad project - https://github.com/zamoose/themehookalliance. I'm a big fan of hooks, personally. They provide a means to keep things within the theme cleaner and easier to maintain.

"_The Theme Hook Alliance is a community-driven effort to agree on a set of third-party action hooks that THA themes pledge to implement in order to give that desired consistency_."


### Bourbon and Neat
---------------
Why use these in this project? It's a philosophical thing. I've used Foundation and Bootstrap before. I like them; they're both great, great projects run by smarter people than myself. So what's the philosophical bit? To achieve the responsiveness required of various projects, I would have to tear up my HTML, input my own selector classes and what have you, in addition to changing my css. I didn't like it. I heard about Neat (http://neat.bourbon.io) and really liked their approach to a grid framework. You keep your HTML structure the way you like and all of the styling in your Sass files

### Use as a Parent Theme?
---------------
I don't see why not. ~~I haven't done it yet.~~ ( I'm using a child theme on http://alexhasnicehair.com ) But with the addition of Theme Hook Alliance, I'd say 'Some Like it Neat' would make for a good Parent Theme for your project and certainly more ideal if you're going to make significant edits (and why wouldn't you? By default it looks like pooh!).

What I recommend is that you generate your child theme, setup your child theme folder, style.css file. Additionally, I think it's just easier to copy the 'library' folder from the parent and place it into the child theme.

### Getting Started aka What You Need to Know...
---------------
Well, to use this theme, you'll definitely want to learn Sass. It's what Bourbon and Neat are built on top of and is at the core of this theme's build.

### Folder Structure
---------------
I haven't listed out every single file here; but I have listed out the files that you'll most likely work with during
a project.

<pre style="max-height: 300px;"><code>Theme Root
    │    ├── assets
    │    │   ├── css
    │    │        ├── rtl-min.css
    │    │        ├── rtl.css
    │    │        ├── style-min.css
    │    │        ├── style.css
    │    │   ├── js
    │    │        ├── production-min.js
    │    │        ├── production.js
    │    ├── sass
    │    |   └── base (Bitters)
    │    |   └── bourbon
    │    |   └── font-awesome
    │    |   └── components
    |    |    |   ├── _buttons.scss
    |    |    |   ├── _dashicons.scss
    |    |    |   ├── _flexnav.scss
    |    |    |   ├── _navigation.scss
    |    |    |   ├── _ui-bourbon.scss
    |    |    |   └── _variables.scss
    │    |    └── layouts
    |    |    |   ├── _content.scss
    |    |    |   ├── _footer.scss
    |    |    |   ├── _header.scss
    |    |    |   ├── _navigation.scss
    |    |    |   ├── _normalize.scss
    |    |    |   ├── _sidebar.scss
    |    |    |   ├── _structure.scss
    |    |    |   └── _typography.scss
    │    |    └── neat
    |    ├── _app.scss
    |    ├── _flexnav.scss
    |    ├── _grid-settings.scss
    |    ├── _rtl.scss
    |    └── style.scss
    ├── library
    │   ├── languages
    │   │   ├── digistarter.pot
    │   ├── vendors
    │   │   ├── js
    │   │   ├── tgm-plugin-activation
    │   │   ├── tha-theme-hooks
    │   │   └── wp-customizer
    │   ├── custom-header.php
    │   ├── extras.php
    │   ├── jetpack.php
    │   └── template-tags.php
    ├── page-templates
    │     ├── partials
    |     |   ├── content-aside.php
    |     |   ├── content-audio.php
    |     |   ├── content-chat.php
    |     |   ├── content-gallery.php
    |     |   ├── content-image.php
    |     |   ├── content-link.php
    |     |   ├── content-none.php
    |     |   ├── content-page.php
    |     |   ├── content-quote.php
    |     |   ├── content-single.php
    |     |   ├── content-status.php
    |     |   ├── content-video.php
    |     |   └── content.php
    |     ├── template-full-width.php
    |     ├── template-left-col.php
    |     └── template-right-col.php
    ├── .bowerrc
    ├── 404.php
    ├── archive.php
    ├── comments.php
    ├── footer.php
    ├── functions.php
    ├── gulpfile.js
    ├── header.php
    ├── index.php
    ├── license.txt
    ├── package.json
    ├── page.php
    ├── README.md
    ├── rtl.css
    ├── search.png
    ├── searchform.php
    ├── sidebar.php
    ├── single.php
    └── style.css</code></pre>

### General Credits and Thanks
---------------
A special thanks to all the folks who inspire me on a daily basis to "do more" with what I know and what I can contribute.

* Brandon Dove
* Nikhil @techvoltz
* Jon Brown
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
* And a <del>fuckload</del> lot more that I'm missing here.

License
---------------

This theme is based on Underscores, (C) 2012-2013 Automattic, Inc.
 - Source: http://underscores.me/
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

Bi-App-Sass
- Source: http://anasnakawa.github.io/bi-app-sass/
- License: the MIT License
- License URI: https://github.com/anasnakawa/bi-app-sass/blob/master/LICENSE

