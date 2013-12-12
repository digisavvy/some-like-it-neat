# some-like-it-neat


### A WordPress Theme Using _s, Bourbon + Neat and Theme Hook Alliance
=======

I got bored on a Saturday and set out to build a super basic WordPress theme. Not enough damn peyote and more than enough time makes for a potent mix of futility... I need a girlfriend. Send help! This is my initial baseline for this project. There's stuff to add and stuff to take away... So there's that.

**Okay, so, right now here's where we're at:**

* Underscores (_s) based theme. There's smarter folks than me building great shit (http://underscores.me)
* Sass. We're using it and to update this theme you should be cozy with it or get ready to learn how to use. As of the initial writing of this ReadMe, I've been using Sass like a piece of shit asshole. I don't know what the fuck I'm doing. So if you do, please feel free to school a chump! If you don't know Sass, you should definitely jump in. The water's fine and you'll thank me later. I accept thanks in burritos, doritos, fritos and cheetos only.
* Responsive — Eh. I mean, it's about as minimal as you can get, but it's there.
* Merge requests welcome...

Shit I included just because
---------------
I admit it. I just add things because I think they're cool. It's a bad habit... You should see my collection of hats and socks. 

* Google Fonts (Just Oswald and Droid Serif)
* Font Awesome: Icon Fonts! (http://fontawesome.io)
* Genericons: MOAR ICON FONTS!! Truthfully, these are here because they have a WordPress Fonticon (http://genericons.com)
* Superfish Menus: Handles drop down nav nicely. (http://users.tpg.com.au/j_birch/plugins/superfish/)
* Meanmenu: Hamburger menu when you get down to mobile viewports (https://github.com/weare2ndfloor/meanMenu)

Coming Soon
---------------

* ~~Theme Hook Alliance Integration. Yeah, I'm lazy. That's next on my to-do list! You guys sound like my mother!~~ — Theme is now partially 'hooked-up'. That is, template part files, located in '/partials' have had THA hooks added... Other files will be done soon. Feel free to add em yourself, if you have a minute!
* Finish Hooking-up (Theme hook alliance)
* Further use of WP Customizer. I don't know how to use the fucking thing, so tips are appreciated; so don't be a lazy turd!

Getting Started
---------------

~~I'll be coming back to this later~~

### Sass Structure
---------------
I definitely need some advice here. Simpler is better in my mind. OCD can be a real pain. So feel free to lend a hand.

theme_root/library  

/ scss  

- style.scss (The file that directly gets compiled by Sass. Output style.scss to your theme's root directory)

- _bootstrap.scss (The file that we use to import all of our Sass files, except style.scss of course!)

- _grid-settings.scss (if you're editing grid, columns and gutters, you'll need to create and import this file) 


 
- bourbon  (Bourbon Sass Goodies library from http://bourbon.io) 

- grid-settings  (Necessary if you're setting your own number of columns. Docs at http://neat.bourbon.io)  
- framework  (Refers to styles that make up the bulkd of the 'standard structure' for the site's layout)
---- _breakpoints.scss (Where we define our responsive breakpoints)  
---- _global.scss (Normalized styles)  
---- _reset.scss (Style resets)   
---- _structure.scss (Basic structural styles for basic scaffolding. As agnostic as possible)  
---- _typography.scss  (Typograhpical related styles)  

- modules  
---- _buttons.scss  (Where we'll place styles for buttons)  
----  _helpers.scss  (A part of the bourbon/neat grid framework)  
---- ~~typography.scss~~  (Moved this to 'framework')  
----  _variables.scss  (Site specific variables can go here)  

- neat  (our grid framework. See docs over at http://neat.bourbon.io) 
 
- Sections  (These are styles relating to the structure and style of the site that goes beyond basic/agnostic structural styling)  
---- aside  (styles related to sidebars and widget areas)  
---- content  (styles related to primary content area)  
---- header (for styles, not relating to navigation, that existin within the header)  
---- navigation  (for nav specific styling)  


