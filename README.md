

WP Foundation for Sites Starter v1.0.0
===

WP Foundation for Sites Starter is a minimal Wordpress theme meant for hacking, so don't use this as a Parent Theme. Built with ZURB's Foundation for Sites and Auttomatic's `_s` starter theme, this theme provides a basic skeleton to get started building a Foundation 6 based theme. The complete F6 css is included, however most of the components are not implemented into the theme. I prefer to implement F6 features on as needed basis rather than spend time removing unused code: it's a skeleton, not an out-of-box solution.


Getting Started
---------------

The first thing you want to do, after installing the theme, change the name to something else, and then you'll need to do a five-step find and replace on the name in all the templates.

* Search for: `'f6-starter'` and replace with: `'newthemename'`
* Search for: `f6_starter_` and replace with: `newthemename_`
* Search for: `Text Domain: f6-starter` and replace with: `Text Domain: newthemename` in style.css.
* Search for: <code>&nbsp;WP&nbsp;Foundation&nbsp;for&nbsp;Sites&nbsp;Starter</code> and replace with: <code>&nbsp;New&nbsp;Theme&nbsp;Name</code>
* Search for: `f6-starter-` and replace with: `newthemename-`

Then, update the stylesheet header in `style.css` and the links in `footer.php` with your own information. Next, update or delete this readme.

Now you're ready to go!



Dependencies
---------------

* [ZURB Foundation For Sites 6.2.3] (http://foundation.zurb.com/sites.html)
* [Motion UI 1.2.0] (http://foundation.zurb.com/sites/docs/motion-ui.html)
* [FontAwesome Icon Set 4.6.3] (http://fontawesome.io)



Credits and Licenses
---------------

Everything included in the theme is open-source, so feel free to download or fork it as you see fit. If you have improvements or additions, I'd love to hear about them!

* Foundation for Sites is licensed [MIT License] (https://github.com/zurb/foundation-sites/blob/develop/LICENSE)
* Motion-UI is licensed [MIT License] (https://github.com/zurb/motion-ui/blob/master/LICENSE)
* What-Input is licensed [MIT License] (https://github.com/ten1seven/what-input/blob/master/LICENSE)
* Font-Awesome is [fully open source ] (http://fontawesome.io/license/)
* _s Starter Theme is licensed [GPLv2 or later] (https://www.gnu.org/licenses/gpl-2.0.html)

