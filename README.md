# Genesis Sample Theme with Gulp & Sass


Hi!

I'm a fork of the official [Genesis Sample](https://github.com/copyblogger/genesis-sample) theme, but with modern build tools like: [Gulp](http://gulpjs.com/), [LibSass](http://sass-lang.com/), [PostCSS](https://github.com/postcss/postcss), [Bourbon](http://bourbon.io/), [Neat](http://neat.bourbon.io/), and [BrowserSync](https://www.browsersync.io/) to help make your development process fast and efficient. 

## Getting Started

### Prerequisites

Because I'm bundled with Gulp, basic knowledge of the command line and the following dependencies are required: [Node](http://nodejs.org/) and [Gulp CLI](https://github.com/gulpjs/gulp-cli) (`npm install -g gulp-cli`).

### Installation Instructions
[Download This Theme](https://github.com/gregrickaby/genesis-sample/archive/master.zip) (.zip)

1. Add the Genesis Sample theme folder in the wp-content/themes/ directory. (The Genesis parent theme needs to be in the wp-content/themes/ directory as well.)
2. Go to your WordPress dashboard and select Appearance.
3. Activate the Genesis Sample theme.
4. Inside your WordPress dashboard, go to Genesis > Theme Settings and configure them to your liking.

## Development

After you've installed and activated me. It's time to setup Gulp.

1) From the command line, change directories to your new theme directory

```bash
cd /your-project/wordpress/wp-content/themes/genesis-sample
```

2) Install Node dependencies

```bash
npm install
```
![Install and Gulp](https://dl.dropbox.com/s/xceger83jq5tncw/genesis-sample-theme-gulp.gif?dl=0)

### Gulp Tasks

From the command line, type any of the following to perform an action:

`gulp watch` - Automatically handle changes to CSS, JS, SVGs, and image sprites. Also kicks off BrowserSync.

`gulp icons` - Minify, concatenate, and clean SVG icons.

`gulp i18n` - Scan the theme and create a POT file

`gulp sass:lint` - Run Sass against WordPress code standards

`gulp scripts` - Concatenate and minify javascript files

`gulp sprites` - Generate an image sprite and the associated Sass (sprite.png)

`gulp styles` - Compile, prefix, combine media queries, and minify CSS files

`gulp` - Runs the following tasks at the same time: i18n, icons, scripts, styles, sprites

### What about Grunt?

Grunt is still available, but wont be supported going forward. [Download](https://github.com/gregrickaby/genesis-sample/tree/v2.2.2-grunt) the [Grunt branch](https://github.com/gregrickaby/genesis-sample/tree/v2.2.2-grunt).

## Support

* For Genesis support, please visit [http://my.studiopress.com/help/](http://my.studiopress.com/help/)
* For support with this theme, visit [https://github.com/gregrickaby/genesis-sample/issues](https://github.com/gregrickaby/genesis-sample/issues)
