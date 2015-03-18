# Changelog
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
