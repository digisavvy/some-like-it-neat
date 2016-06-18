# Changelog

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
