# [Felix - A Boilerplate Theme](https://github.com/StJoeWeb/Felix)

A custom quick start theme for WordPress built on top of HTML5 Boilerplate and SASS-flavored Twitter Bootstrap 3.1.1. Built in support for Bower, Grunt and SASS. Named for Marcus Minucius Felix, of which very little is known, other than he is the author of Octavius.


* Project: [https://github.com/StJoeWeb/Felix](https://github.com/StJoeWeb/Felix)
* Website: [St.Joe Web](http://stjoeweb.com)
* Twitter: [@StJoeWeb](http://twitter.com/stjoeweb)
* Authors : [Caleb Zahnd](http://calebzahnd.com) // [@CalebZahnd](http://twitter.com/calebzahnd) & [Nate Arnold](http://natearnold.me) // [@arnonate](http://twitter.com/arnonate)

### Getting Started

Felix is an attempt at creating the best possible environment for custom WordPress Theme development. Grunt automates many tasks for us such as compiling SCSS files, concatenating and minifying CSS and JS, and compressing images. The first step to activating this environment is installing [Node](http://nodejs.org) and [Grunt CLI](http://gruntjs.com) tools. We have found [NVM](https://github.com/creationix/nvm) to be the easiest way to get started with Node. Support for Bower is built in, letting you grab and update web packages with ease. Adding custom metaboxes or a custom admin panel to the WordPress wp-admin screen is a cinch, using the files included in the /functions/ directory. Documentation coming soon, but we bet you can figure it out.

***

#### Installing Node Modules

After downloading or cloning this repo, you will need to install the necessary Node Modules using a simple npm command `npm install`. You can view the necessary dependencies by cracking open the included package.json file.

#### Defining tasks with Grunt

Check out the included Gruntfile.js to see how we have currently configured Grunt to run with Felix.

To simplify things we have only included the following 2 tasks:

```
grunt
```
This will compile SCSS and concatenate JS and run the compile CSS through an autoprefixer. It will also set grunt in watch mode. This task will run every time there is a change to a SCSS, JS, PHP, or HTML file.

```
grunt pro
```
This will compile SCSS and concatenate JS. It will also add prefixes and minify CSS and minify JS. Images are also compressed and exported during this step. All compiled and compressed output is placed in the /assets/ directory

***

Enjoy Felix and let us know how we can improve it :)
