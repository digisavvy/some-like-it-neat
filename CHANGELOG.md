# Changelog

### 1.6.2
-------------
* **Big change** — Removed Gulp and replaced with [Laravel Mix](https://laravel.com/docs/5.6/mix#introduction). This was done to simplify
things from a build standpoint. Also, I found webpack, itself, to be very
intimidating and difficult to begin with. Mix is soooo much easier to set up. Good by Jason Beastly gulpfile config. Be sure to checkout updated readme.md docs to get started.

### 1.6.1
-------------
* Added basic support for Gutenberg blocks.
* Add editor styles for Gutenberg edit screen.
* Update hoek npm package.
* Update lodash npm package.
* Summer cleaning of Sass files (reorganizing).
* Updated Normalize with https://github.com/JohnAlbin/normalize-scss
* Fix - Post Date link was going to permalink instead of archive link.

### 1.6
-------------
* **Big change** — Removed Neat grid-column() functions in favor of [CSS Grid](https://developer.mozilla.org/en-US/docs/Web/CSS/grid). Neat Still works, but is no longer used to define layouts. It is now primarily used for its `grid-media` function for setting up variable breakpoints. If you want to continue using Neat to define layouts it’s still there and you can do that. I recommend pushing ahead with CSS Grid, it’s great and the Mozilla Developer Network docs are fantastic (linked above). Also check out [Wes Bos’s free course](https://wesbos.io)
* Fix issue with `_headroom.scss` not getting included in project files.

### 1.5.1
-------------
* Re-added PHPCS support, hat tip Rachel Cherry @bamadesigner
* Added support for Beaver Themer (ab4095567e71db3cbeb6aee02bb0bc4eac8bd1d4)
* General styling/formatting and bug fixes and updates
* Removed bi-app-sass, we're looking for alternate RTL support, may be better supported in Bourbon
* Replaced CMB2 with Carbon Fields and added as Composer Dependency.
* Fix - Theme activation would crash site if you didn't run `composer install` first. Thanks @bamadesigner

### 1.5.0
-------------
* Updated to Neat 2.0
* Updated Bourbon to stable beta 5.0
* Add Offcanvas Menu. Selectable within the Customizer. Now you can choose between offcanvas or flexnav.
* Updated sass file organization
* Updated Merge pull request #104 from jacobarriola/patch-1
* Updated Functions.php, split into smaller more specific files for better organization and lighter functions file.
* Add Gulp Task for processing offcanvas and other addon sass styling processes.
* Fix issue with prod.css and dev.css files getting created even when no files exist in js folder.

### 1.4.3
-------------
* Add - Offcanvas navigation menu. Configurable from the Customizer. Conditionally loads styles/scripts if selected.
* Update - Various NPM packages. Notable: Neat 1.7.4
* Update - Added second 'styles' task to run offcanvas styles, looking for better method to include them

### 1.4.2
-------------
* Fix - Prevent Neat 2.0 from downloading (it's coming, so keep awares).

### 1.4.1
-------------
* Change - Moved Bi-app-sass to NPM from Bower.
* Change - Remove Bower; we're using NPM for package mgmt completely.
* Update - TGMP to 2.6.1
* Update - Various NPM Packages. Commit: 5a8d5ab0bee0b19cb78ceb8b8a4ad5c273928a7e
		
### 1.4.0
-------------
**Bugfixes**
* Fix - Issue with gulp not recognizing new scss files, which required a restart of gulp. Thanks @jacobarriola.
* Update - Node Bourbon package to 4.2.8

### 1.3.9
-------------
**Bugfixes**
* Add - CMB2 Support to add custom metaboxes on singular post types. Allows for hiding titles and removing featured images. Useful for landing page templates.
* Remove - Removed fallback for get_post_navigation(). Get current folks!
* Remove - Removed comments from page post type. Personal feeling they aren't needed.
* Fix - Invalid JSON in bower.json
* Fix - Bourbon removed an extend rule for OL and UL that was breaking Sass compilation. See related: https://github.com/thoughtbot/bitters/pull/199


### 1.3.8
-------------
**Bugfixes**
* Change - Full width template changed so that nav, footer, comments sections were fixed-width. Only content area is full-width now.

### 1.3.7
-------------
**Features**
* Added  x-ua-compatible for improved legacy browser support. Thanks to @bryanwillis for that PR. =)
* Change - Using Bourbon's px to rem function  instead of the custom function I had been using

**Bugfixes**
* Fixed issue with development.js script. The .min suffix was getting added after a recent update. I fixed that and re-enabled conditional loading of production-min.js and development.js

### 1.3.6
-------------
* Cleanup some redundancies in the scripts we include. Thanks @bryanwillis (https://github.com/bryanwillis)

### 1.3.5
-------------
* Added Full width landing page template. No sidebars, header, or footer

**Bugfixes:**
* Resolve UTF-8 char encoding output issue.

### 1.3.4
-------------

**Features:**
* Updated deprecated gulp-run-sequence - https://www.npmjs.com/package/run-sequence
* Uncommented production and development js files by default.

### 1.3.3
-------------

**Bugfixes:**
* Resolve issue SLIN working with Node 4+
* Replace gulp-combine-media-queries with gulp-group-css-media-queries

### 1.3.2
-------------
* Added html5 support for comments and forms
* Cleanup syntax formatting, still a work-in-progress
* Fix Webmaster User Role Plugin URL in TGM. Thanks Tyler Digital!

**Bugfixes:**
* Cleanup various php files that got botched in phcbf tasks
* Resolve

### 1.3.1
-------------
* Removed 'gulp-rimraf' and replaced with npm 'del'.
* Update font size and color using variables instead of hard-coded ones.
* Fix Webmaster User Role Plugin URL in TGM. Thanks Tyler Digital!

**Bugfixes:**
* Cleanup Gulpfile, removing references for tools we're not using and also file calls we're not using.

### 1.3.0
-------------

**Features:**
* Aaaand removed TGM and THA from composer. See commit: 704de21e for details

**Bugfixes:**
* Fix issue with duplicate title being written.

### 1.2.9
-------------

**Features:**
* Added TGM Plugin Activation and Theme Hook Alliance to Composer for better package mgmt.
* Moved Composer and dependencies to /library/vendors/composer. Thx to Mr. Rob Neu for adding THA to Packagist
* Added Omega Reset Mixin

**Bugfixes:**
* Got build process working again
* Fixed Left Sidebar Template issue where sidebar wouldn't display on the left.
* Fixed issue with #main and #page selectors improperly placed.

### 1.2.7
-------------
**Features:**

* Now using gulp-sass (libsass) for compiling Sass files. MUCH quicker compiling now
* Sourcemaps are working now, they are created by default. Should make developing a little more simple. Only tested in Chrome thus far.
* Added 'Attachment' page template. Why? Cause I'm anal like that.

**Bugfixes:**
* Removed duplicate "main" markup.

### 1.2.6
-------------
**Bugfixes:**

* Fix project URL implementation. Bad developer (smacks hand!). Project variable should be the complete project string. The domain extension was hardcoded in the browser-sync task. #failhard.bomb

### 1.2.5
-------------
**Features:**

* Added Customizer Controls/Settings for enabling/disabling post formats
* Added Customizer Controls/Settings for hiding/showing WordPress Credits
* Removed built-in adjacent post navigation in favor of get_the_post_navigation()

### 1.2.4
-------------
**Features:**

* Added theme support for Infinite Scroll

**Bugfixes:**

* Moved around markup. Specifically moved the "Main" selector/tag to wrap both "Primary" and "Secondary" selectors and moved "Content" inside of the "Primary" selector.

### 1.2
-------------

**Features:**

* Added Composer for dependencies
* Added support for PHPCS and WordPress Coding Standards
* Bourbon, Neat and Bi-App are now controlled via Bower, so make sure you do bower install
* Bower dependent js have been been removed from bower and instead enqueued in the theme directly for greater compatibility
* Making use of title tag support
* Added Archive description via get_the_archive_description()

**Bugfixes:**

* Fixed some text translation issues in code
* Changed prefix and text-domains to some_like_it_neat_ from some_like_it_neat_
* Removed Example Content such as Customizer Example panel and tgm-example-plugin.zip
* Rename wp-customizer folder and functions to just customizer, for purposes relating to core naming conventions and avoiding conflicts there.
* Remove orphaned rtl.css file
* Resolve 2 Yoda conditions
* General Style Tweaks/Fixes

### 1.1.11
-------------

**Features:**

* This is a doozy. Adding RTL Support using Bi-App. For this to work, we're changing how we compile styles a bit. Instead of putting all of your styles in style.scss, we're now placing them in app.scss. Will explain more in the Readme.md file.

### 1.1.10
-------------

**Features:**

* Added support for get_the_archive_title() in the archive template
* Added support for

### 1.1.10
-------------

**Features:**

* General tweaks to Customizer Settings Area. Utilizing panels to separate settings.

**Bugfixes:**

*

### 1.1.9
-------------

**Features:**

* Added Example Customizer 4.0 Controls and Settings with a Panel for use/customization

**Bugfixes:**

* Updated non-tanslated strings in Customizer
* Updated textdomain in Thomas Griffin Plugin Activation script to "some_like_it_neat"

### 1.1.8
-------------

**Features:**

* Push for Internationalization and Localization
* Translations for EN US
* Translations for Spanish (I hope...)

### 1.1.7
-------------

**Features:**

* Improve Accessibility
*** Removed Link Title Text in all page templates
*** Created greater contrast for menus and buttons
***

**Bugfixes:**

* Replace touch button navicon with nav button now that Customizer properly shows on default

### 1.1.6
-------------

**Features:**


**Bugfixes:**

* Fixed issue with Customizer Defaults not showing on front-end upon theme activation

### 1.1.5
-------------

**Features:**

* Adding sass files for page templates
* Accessibility Improvements

**Bugfixes:**

* Fixed issue with multiple line endings in production.js

### 1.1.4
-------------

**Features:**

* Splitting Gulp Config into multiple files


### 1.1.3
-------------

**Bugfixes:**

* Fixed browser reload issue on changes to js files

### 1.1.2
-------------

**Features:**

* Making more changes to make theme accessibility friendly


### 1.1.0
-------------

**Features:**

* Flagged theme as 'accessibility-ready'

**Bugfixes:**

* Removed duplicate hooks from content-none.php

### 1.1.0
-------------

**Features:**

* Making this theme accessibility ready out-of-the-box

### 1.0.9
-------------

**Features:**

* No, seriously, added a getting started area in the README.md file. Be sure to check it out.

**Bugfixes:**

* Fixed inconsistent text domain usage
* Replaced Screenshot image
* Remove unused script calls, which were previously commented-out

### 1.0.8
-------------

**Features:**

* No, seriously, added a getting started area in the README.md file. Be sure to check it out.


### 1.0.7 (initial release)
-------------

**Features:**

* Is a ""getting started guide"" a feature?

**Bugfixes:**

* Placing sanitize_callback functions in their proper place in the customizer

