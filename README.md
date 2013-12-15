# some-like-it-neat


### A WordPress Theme Using _s, Bourbon + Neat and Theme Hook Alliance
=======

I got bored on a Saturday and set out to build a super basic WordPress theme. Not enough damn peyote and more than enough time makes for a potent mix of futility... I need a girlfriend. Send help! This is my initial baseline for this project. There's stuff to add and stuff to take away... So there's that.

**Okay, so, right now here's where we're at:**

* Underscores (_s) based theme. There's smarter folks than me building great shit (http://underscores.me)
* SASS. We're using it and to update this theme you should be cozy with it or get ready to learn how to use. As of the initial writing of this ReadMe, I've been using SASS like a piece of shit asshole. I don't know what the fuck I'm doing. So if you do, please feel free to school a chump! If you don't know SASS, you should definitely jump in. The water's fine and you'll thank me later. I accept thanks in burritos, doritos, fritos and cheetos only.
* Theme Hook Alliance — One of the things I learned to love about working with Frameworks were their hooks. Thematic and Genesis introduced me to the notion. Since them I've been using them like they're going out of style. When I set out to make my own starter theme I wanted to make something that had "just the right amount" of features for me. I knew I needed hooks. The THA project was intro'd to me by Brandon Dove, at the OCWP (http://ocwp.org) developer's day meetup. Thought it was super neat. So I bundled that hot mess right into this thing.
* Responsive — Eh. I mean, it's about as minimal as you can get, but it's there.
* Merge requests welcome...

Shit I included just because
---------------
I admit it. I just add things because I think they're cool. It's a bad habit... You should see my collection of hats and socks. 

* ~~Google Fonts (Just Oswald and Droid Serif)~~ Dropped these fonts. Not needed. If you want web fonts, you'll do it yourself anyway.
* ~~Font Awesome: Icon Fonts! (http://fontawesome.io)~~ Already using Genericons. If you want these, you'll use em anyway.
* Genericons: Truthfully, these are here because they have a WordPress Fonticon (http://genericons.com)
* Superfish Menus: Handles drop down nav nicely. (http://users.tpg.com.au/j_birch/plugins/superfish/)
* Meanmenu: Hamburger menu when you get down to mobile viewports (https://github.com/weare2ndfloor/meanMenu)
* Menu Walker Class for Menu Descriptions: Menu descriptions like it's 2008, mofo!

Coming Soon
---------------

* ~~Theme Hook Alliance Integration. Yeah, I'm lazy. That's next on my to-do list! You guys sound like my mother!— Theme is now partially 'hooked-up'. That is, template part files, located in '/partials' have had THA hooks added... Other files will be done soon. Feel free to add em yourself, if you have a minute!~~  Theme template files have all been "hooked up" with THA hooks.
* Further use of WP Customizer. I don't know how to use the fucking thing, so tips are appreciated; so don't be a lazy turd!

Getting Started
---------------

~~I'll be coming back to this later~~

### Theme Hook Alliance
---------------

What is Theme Hook Alliance? It's a pretty rad project - https://github.com/zamoose/themehookalliance. I'm a big fan of hooks, personally. They provide a means to keep things within the theme cleaner and easier to maintain.

"_The Theme Hook Alliance is a community-driven effort to agree on a set of third-party action hooks that THA themes pledge to implement in order to give that desired consistency_."


### Bourbon and Neat
---------------
Why use these in this project? It's a philosophical thing. I've used Foundation and Bootstrap before. I like them; they're both great, great projects run by smarter people than myself. So what's the philosophical bit? To achieve the responsiveness required of various projects, I would have to tear up my HTML, input my own selector classes and what have you, in addition to chaniging my css. I didn't like it. I heard about Neat (http://neat.bourbon.io) and really liked their approach to a grid framework. You keep your HTML structure the way you like and all of the styling in your SASS files

### Use as a Parent Theme?
---------------
I don't see why not. I haven't done it yet. But with the addition of Theme Hook Alliance, I'd say 'Some Like it Neat' would make for a good Parent Theme for your project.

### SASS Structure
---------------
I definitely need some advice here. Simpler is better in my mind. OCD can be a real pain. So feel free to lend a hand.

theme_root/library  

/ scss  

- style.scss (The file that directly gets compiled by SASS. Output style.scss to your theme's root directory)

- _bootstrap.scss (The file that we use to import all of our SASS files, except style.scss of course!)

- _grid-settings.scss (if you're editing grid, columns and gutters, you'll need to create and import this file) 


 
- bourbon  (Bourbon SASS Goodies library from http://bourbon.io) 

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

### General Credits and Thanks
---------------
A special thanks to all the folks who inspire me on a daily basis to "do more" with what I know and what I can contribute.

* Brandon Dove
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
* And a fuckload more that I'm missing here.