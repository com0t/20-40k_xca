=== ShortPixel Adaptive Images ===
Contributors: ShortPixel
Tags: adaptive images, responsive images, resize images, scale images, cdn, optimize images, compress images, on the fly, webp, lazy load, avif
Requires at least: 4.7
Tested up to: 5.8
Requires PHP: 5.6.40
Stable tag: 3.1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Start serving properly sized, smart cropped & optimized images, plus CSS, JS and fonts from our CDN with a click; On the fly convert AVIF & WebP support.

== Description ==

**An easy to use plugin that can help you solve within minutes all your website’s image-related problems.**

Display properly sized, smartly cropped and optimized images on your website; Images are processed on the fly and served from our CDN, in the next-gen WebP & AVIF formats, if the browser supports it.

= Do I need this plugin? =
If you have a WordPress website with images then the answer is: most probably yes!
Did you ever test your website with tools like <a href="https://developers.google.com/speed/pagespeed/insights/" target="_blank">PageSpeed Insights</a> or <a href="https://gtmetrix.com/">GTmetrix</a> and received complains about images not being properly sized or being too large? Or that you should use "next-gen" images like WebP or AVIF? Or that the website should "defer offscreen images"?
ShortPixel Adaptive Images comes to the rescue and resolves your site's image-related problems in no time.

= What are the benefits? =

[vimeo https://vimeo.com/407181635 ]

Imagine that you could have all your image-related website problems solved with a simple click, wouldn't that be great?
Usually the images are the biggest resource on a website page. With just one click, ShortPixel Adaptive Images replaces all your website's pics with properly sized, smartly-cropped, optimized images and offloads them on to the ShortPixel's global CDN.
And for more Google love the plugin serves <a href="https://en.wikipedia.org/wiki/WebP">WebP</a> and <a href="https://en.wikipedia.org/wiki/AV1#AV1_Image_File_Format_(AVIF)">AVIF</a> images to the right browsers auto-magically!

= What are the features? =
* new, lightweight, pure JavaScript Adaptive Images engine (jQuery not required anymore) starting with version 3
* same visual quality but smaller images thanks to ShortPixel algorithms
* smart cropping - <a href="https://help.shortpixel.com/article/182-what-is-smart-cropping" target="_blank">see an example</a>
* serve only appropriately sized images depending on the visitor's viewport
* lazy load support with adjustable threshold; browser native lazy loading support is also available
* automatically serves WebP & AVIF images to browsers that support this format. Animated Gifs are supported too!
* caching and serving from a global CDN for images, as well as CSS, JS and fonts
* all major image galleries, sliders, page builders are supported
* onboarding wizard which includes a tool that suggests the best settings for each site
* Low Quality Imaage Placeholders (LQIP) support
* support for JPEG, PNG, GIF, TIFF, BMP
* convert to WebP and AVIF on the fly
* adjustable size breakpoints when resizing images
* possibility to deactivate the plugin functionality for logged-in users
* variety of settings for an increased flexibility in the plugin functionality


= Do I need an account to test this plugin? =
No, just go ahead and install then activate it on your WordPress website and you’ll automatically receive 500 image optimization credits, which equals to 2.5GB of CDN traffic, or approximately 2500 visits!

= How much does it cost? =
When using ShortPixel Adaptive Images, only the CDN traffic <a href="https://help.shortpixel.com/article/460-spai-new-how-are-the-credits-counted">is counted</a>, if you choose to use our CDN. The free tier receives 100 image optimization credits, which equals to 500MB of CDN traffic, or approximately 500 visits. Paid plans start at $4.99 and both <a href="https://shortpixel.com/pricing-one-time">one-time</a> and <a href="https://shortpixel.com/pricing">monthly</a> plans are available.
Even better: if you already use <a href="https://wordpress.org/plugins/shortpixel-image-optimiser/">ShortPixel Image Optimizer</a> then you can use the same credits with ShortPixel Adaptive Images!

= How does this work? =
Different visitors have different devices (laptop, mobile phone, tablet) each with its own screen resolution. ShortPixel AI considers the device's resolution and then serves the right sized image for each placeholder.
Let's consider a webpage with a single 640x480 pixels image.
When viewed from a laptop the image will retain it 640x480px size but it will be optimized and served from a CDN.
When the same webpage is viewed from a mobile phone, the image will be resized (for example) to 300x225px, optimized and served from CDN.
This way, neither time nor bandwidth will be wasted by visitors.
Please note that the first time the call for a specific image is made to our servers, the original image will be served temporarily.

**Other plugins by ShortPixel**

* Image optimization & compression for all the images on your site, including WebP & AVIF delivery - <a href="https://wordpress.org/plugins/shortpixel-image-optimiser/" target="_blank">ShortPixel Image Optimizer</a> 
* Easily replace images or files in Media Library - <a href="https://wordpress.org/plugins/enable-media-replace/" target="_blank">Enable Media Replace</a>
* Regenerate thumbnails plugin compatible with the other ShortPixel plugins - <a href="https://wordpress.org/plugins/regenerate-thumbnails-advanced/" target="_blank">reGenerate Thumbnails Advanced</a>
* Make sure you don't have huge images in your Media Library - <a href="https://wordpress.org/plugins/resize-image-after-upload/" target="_blank">Resize Image After Upload</a>

== Frequently Asked Questions ==

= What happens when the quota is exceeded? =

In your WP dashboard you'll be warned when your quota is about to be exhausted and also when it was exceeded. When the quota is exhausted, the plugin will simply serve the original images from your server, without compression or resizing, until the quota resets.
The images that weren't already optimized will be served directly from your website.

= What Content Delivery Network (CDN) do you use? =

ShortPixel Adaptive Images uses <a href="https://bunny.net/" target="_blank">bunny.net</a> to offload the images - a global CDN with <a href="https://bunny.net/network" target="_blank">54 edge locations</a> around the world.
Both free and paid plans use the same CDN with the same number of locations.
You can independently check out how the bunny.net CDN compares to other CDN providers <a href="https://www.cdnperf.com/">here</a> (wordlwide) and <a href="https://www.cdnperf.com/#!performance,North%20America">here</a> (North America).

= Can I use a different CDN? =

Sure. <a href="https://help.shortpixel.com/article/180-can-i-use-a-different-cdn-with-shortpixel-adaptive-images">Here</a> you can see how to configure it with Cloudflare and <a href="https://help.shortpixel.com/article/200-setup-your-stackpath-account-so-that-it-can-work-with-shortpixel-adaptive-images-api">here</a>’s how to configure it with STACKPATH. Please note that when using a different CDN, image credits will be consumed instead of CDN traffic.
If you need further assistance please <a href="https://shortpixel.com/contact">contact us</a>

= What happens if I deactivate the plugin? =
You can stop using the SPAI whenever you want but this means your site will suddenly become slower.
Basically, your website will revert to the original, un-optimized images served from your server.

= Are there different image optimization levels available? =
Yes, you can compress images as Lossy, Glossy or Lossless.
You can find out more about each optimization level <a href="https://help.shortpixel.com/article/11-lossy-glossy-or-lossless-which-one-is-the-best-for-me">here</a> or can run some free tests to optimize images <a href="https://shortpixel.com/online-image-compression">here</a>

= I already used ShortPixel Image Optimizer, can I also use this? =
Certainly!

= What is the difference between this plugin and ShortPixel Image Optimizer? =
You can see <a href="https://help.shortpixel.com/article/179-shortpixel-adaptive-images-vs-shortpixel-image-optimizer">here</a> the differences between the two services.

= Where can I optimize my images? There's nothing on my admin panel. =
SPAI works differently than a regular image optimizer. <a href="https://help.shortpixel.com/article/132-how-shortpixel-adaptive-images-work" target="_blank">Here's</a> what it does.

= How can I make sure that the plugin is working well? =
You have more information about this <a href="https://help.shortpixel.com/article/240-is-shortpixel-adaptive-images-working-well-on-my-website" target="_blank">here</a>.

= I want to start using the plugin, what should I do? =
The exact instructions for this are available <a href="https://help.shortpixel.com/article/231-step-by-step-guide-to-install-and-use-shortpixel-adaptive-images-spai" target="_blank">here</a>.

= My images are getting redirected from cdn.shortpixel.ai, why? =
Have a look at <a href="https://help.shortpixel.com/article/148-why-are-my-images-redirected-from-cdn-shortpixel-ai" target="_blank">this article</a>.

= SPAI is not working well, I'm having some issues. =
Please check the following things: 
1) Make sure your domain <a href="https://help.shortpixel.com/article/94-how-to-associate-a-domain-to-my-account" target="_blank">is associated to your account</a>;
2) Make sure you have enough credits available in your account;
3) Have a look at <a href="https://help.shortpixel.com/article/220-i-installed-shortpixel-adaptive-images-but-it-doesnt-seem-to-work" target="_blank">this article</a>;
4) Take a look at <a href="https://help.shortpixel.com/category/307-shortpixel-adaptive-images" target="_blank">our knowledge base</a>.

If nothing seems to work, please <a href="https://shortpixel.com/contact" target="_blank">contact us</a>.

== WP CLI commands ==

Use the following WP CLI commands to clear the CSS cache and the Low Quality Image Placeholders:
    `wp shortpixel clear_css`
    `wp shortpixel clear_lqips`

== For developers ==

If in Media Library there are main images which end in the usual thumbnail size suffix (eg. -100x100) please set in wp-config.php this:

    define('SPAI_FILENAME_RESOLUTION_UNSAFE', true);

If you need to do a post-processing in JavaScript after the image/tag gets updated by ShortPixel AI, you can add a callback like this:

    jQuery( document ).ready(function() {
        ShortPixelAI.registerCallback('element-updated', function(elm){
            // elm is the jQuery object, elm[0] is the tag
            console.log("element updated: " + elm.prop('nodeName'));
            });
    });

For changing the original URL of the image, that is detected by ShortPixel, use this filter that receives the original URL:

    add_filter('shortpixel/ai/originalUrl', 'my_function');

Sometimes, when the option to crop the images is active, SPAI thinks it's not safe to crop an image, but you want to crop it anyway. Please add this attribute to force the cropping:

    <img data-spai-crop="true" ....

ShortPixel Adaptive Images triggers a JS event after the initial processing of  the HTML page in browser: spai-body-handled, an event after each processed DOM mutation, if at least one URL was replaced: spai-block-handled and an event after each element has its URL updated lazily (entering the viewport): spai-element-handled

In order to exclude specific images, you can also add the following attributes to the markup, inside the `IMG` tag:

    `<img data-spai-excluded="true" ...>` --> this will completely exclude from processing the image which has this attribute;
    `<img data-spai-eager="true" ...>` --> this will exclude the image from being lazy-loaded by the plugin;
    `<img data-spai-noresize="true" ...>` --> this will prevent the image from being resized by the plugin.

For adding custom replacement rules use:

    add_filter('shortpixel/ai/customRules', 'my_function');

The function will receive an array and should append to that array elements with the following structure: ['tagName', 'attrToBeChecked', 'classFilter', 'attributeFilter', false(reserved), 'attributeValueFilter', isEager(bool)]. Starting 3.0, you can also append ShortPixel\AI\TagRule instances
A real-life example for custom image attributes, a custom srcset and a custom JSON data attribute:

`add_filter('shortpixel/ai/customRules', 'spai_to_iconic');
function spai_to_iconic($regexItems) {
    $regexItems[] = array('img', 'data-iconic-woothumbs-src', false, false, false, false, true);
    $regexItems[] = array('img', 'data-large_image', false, false, false, false, true);
    $regexItems[] = new ShortPixel\AI\TagRule('img', 'srcset', false, false, false, false, false,
                    'srcset', 'replace_custom_srcset');
    $regexItems[] = new ShortPixel\AI\TagRule('div', 'data-default', 'iconic-woothumbs-all-images-wrap', false, false, false, false,
                        'srcset', 'replace_custom_json_attr');
    return $regexItems;
}`



== Screenshots ==

1. Example site metrics on PageSpeed Insights before: Low

2. Example site metrics on PageSpeed Insights after: Good

3. Example site metrics on GTMetrix before: F score

4. Example site metrics on GTMetrix after: B score

5. Main settings page

6. Advanced settings page

== Changelog ==

= 3.1.3 =
Release date: November 24th, 2021
* Fix: Instagram galleries and feeds should be working properly now;
* Fix: the special crop parameter was multiplying the original resolution of the image on retina displays;
* Fix: AVIF was still served in some cases, even if the option was disabled;
* Fix: serve the new AI JS from the custom domain/CDN, if the JS serving from CDN is enabled;
* Fix: file type options were hidden in the settings when only AVIF was active (no WebP);
* Fix: make no resize exclusions remain lazy;
* Fix: when there were HTML comments before the DOCTYPE declaration, SPAI wasn't working properly;
* Language: 0 new strings added, 1 updated, 0 fuzzed, and 0 obsoleted.

= 3.1.2 =
Release date: November 17th, 2021
* Fix: added back the jQuery dependency for the old AI engine;
* Fix: PHP warning that was showing up in certain cases;
* Language: 0 new strings added, 0 updated, 0 fuzzed, and 0 obsoleted.

= 3.1.1 =
Release date: November 12th, 2021
* Fix: deactivate unintentionally left active logging;
* Fix: undefined notice about video-placeholder;
* Fix: various small fixes to the new AI engine's JS processing;
* Language: 0 new strings added, 0 updated, 0 fuzzed, and 0 obsoleted.

= 3.1.0 =
Release date: November 11th, 2021
* New: added Size Breakpoints option for resizing images, especially useful when the images resize a lot on various screen sizes;
* New: the necessary headers are now automatically added when using Apache, in order to avoid CORS issues with the new AI engine;
* New: added font preload support for the CDN (when a CSS file is parsed, the fonts will already be prepared for the CDN);
* New: added separate options for WebP and AVIF, for more control on these settings;
* New: added tooltips for the plugin settings for an easier understanding;
* Compat: added compatibility with the Agile Store Locator plugin;
* Compat: the placeholder image that WP Rocket uses for YouTube embeds is now automatically excluded from being processed;
* Fix: the plugin upgrade notice mechanism wasn't working anymore;
* Fix: the parsing works now in `<style>` blocks when the `background-image` is added right after the `{`;
* Fix: the image dimensions are now properly retrieved from SVG files, when they have it defined either as `viewBox` or as `width` and `height`;
* Fix: LQIP's were always displayed when using the new AI Engine, even if the option was disabled;
* Language: 18 new strings added, 0 updated, 0 fuzzed, and 6 obsoleted.

= 3.0.0 =
Release date: October 14th, 2021
* New: the new Adaptive Images engine (pure JavaScript based, no jQuery required) can now be enabled from the Behavior tab in Settings -> ShortPixel AI;
* New: option to serve the local JS files from the CDN;
* New: local fonts are now served as well from the CDN, when referred from parsed CSS files;
* Tweak: re-enabled the automatic delivery of AVIF for supporting browsers;
* Tweak: various re-wording and spelling corrections throughout the entire plugin strings;
* Tweak: the plugin is now fully tested with PHP8;
* Tweak: removed the option to revert to the 1.8.x settings upon deactivation;
* Fix: fixed various issues with different integrations (caching plugins, galleries etc.);
* Fix: when deactivating the delivery of next-generation images for certain image types, the entire option was wrongly deactivated;
* Language: 18 new strings added, 51 updated, 0 fuzzed, and 12 obsoleted.

= 2.3.3 =
Release date: June 30th, 2021
* Fix: issue with validating API key
* Language: 0 new strings added, 0 updated, 0 fuzzed, and 0 obsoleted.

= 2.3.2 =
Release date: June 29th, 2021
* Temporarily deactivate AVIF pending codec bug fix (https://github.com/xiph/rav1e/issues/2757);
* Language: 0 new strings added, 0 updated, 0 fuzzed, and 0 obsoleted.

= 2.3.1 =
Release date: June 28th, 2021
* New: Version the javascript in the file name in order to get around more stubborn caches;
* Fix: do not parse AJAX responses to uploads;
* Fix: nested element that has a different background - was taking the background of the parent element;
* Fix: notice in logs sometimes when domain info from server;
* Language: 0 new strings added, 0 updated, 0 fuzzed, and 0 obsoleted.

= 2.3.0 =
Release date: June 17th, 2021
* New: images (including the ones from CSS files) are now served automatically in the new AVIF format to supporting browsers;
* New: moved the JS detection mechanism for WebP/AVIF support directly to the CDN level, so no JS is required anymore for this;
* Language: 0 new strings added, 6 updated, 0 fuzzed, and 0 obsoleted.

= 2.2.4 =
Release date: June 14th, 2021
* Compat: added a constant - `SPAI_ELEMENTOR_WORKAROUND` - to deactivate the parsing of Elementor modules that are resulting in critical errors;
* Compat: workaround for WP Rocket that calls in certain circumstances the filter `rocket_css_content` with only one parameter;
* Fix: some warnings when lqip queue is not array were showing up in some cases;
* Fix: wrong array key when the no background calculation can't determine crop size and returns just width and height;
* Fix: iPhone issues with parsing stylesheets while also improving page responsiveness while parsing them (async);
* Language: 0 new strings added, 0 updated, 0 fuzzed, and 0 obsoleted.

= 2.2.3 =
Release date: May 18th, 2021
* New: also parse inside `<script type="text/template">` blocks;
* Fix: the background crop resize wasn't working in several cases, which is now fixed;
* Fix: update the notification text about the next generation images served by SPIO;
* Fix: cases when a mutation has backgrounds from an existing CSS block are now properly handled;
* Fix: the special crop feature now handles correctly the situations when the width parameter isn't the first one;
* Fix: the inline background selector will handle situations with no space before the CSS class definition;
* Fix: remove the default values for JS parameters in order to support IE11;
* Fix: the images from `li` elements added with `data-thumb` are now replaced;
* Fix: the URL exclusions are checked when replacing inside JS blocks too;
* Language: 0 new strings added, 2 updated, 0 fuzzed, and 0 obsoleted.

= 2.2.2 =
Release date: April 29th, 2021
* Fix: the minified version of the plugin CSS files was bigger than the not minified one;
* Fix: find local file when URL contains a path element before wp-content, that is not present on disk;
* Language: 0 new strings added, 0 updated, 0 fuzzed, and 0 obsoleted.

= 2.2.1 =
Release date: April 26th, 2021
* Compat: added integration with Real3D Flipbook;
* Fix: there was a "Class not found" error in some cases when purging LiteSpeed cache from our plugin;
* Fix: in some cases, the size of background images wasn't properly set;
* Fix: protection added for very large number of product variations; the plugin will now work properly in these cases;
* Language: 0 new strings added, 0 updated, 0 fuzzed, and 0 obsoleted.

= 2.2.0 =
Release date: April 20th, 2021
* New: added filter `shortpixel/ai/customRules` for custom replacement rules;
* New: added proper lazy loading for background images;
* New: take into account the `background-*` CSS styles: size, position, etc.;
* New: lazy load the images in the CSS blocks;
* New: handle correctly multiple URLs in the same `background-image:` declaration;
* New: when running out of credits you can now have an option to top-up directly from the plugin settings;
* Compat: added an integration with the Uncode theme and its iLightBox component;
* Compat: added integration with WPC Variations Table;
* Compat: added integration with Soliloquy Slider Plugin;
* Compat: also integrate properly with Divi child themes;
* Compat: improved the integration with Elementor, all images should now be properly replaced;
* Fix: WooCommerce product variations were broken if srcset was present, but false;
* Fix: in certain cases, background images with important CSS priority weren't properly handled;
* Fix: also remove the sizes attribute if we remove the srcset;
* Fix: replacement error when html attribute contains "<style>.." data;
* Fix: various small fixes to settings, fonts, debug messages, ShortPixel account login and lazy loading;
* Language: 7 new strings added, 2 updated, 0 fuzzed, and 3 obsoleted.

= EARLIER VERSIONS =
* please refer to the <a href="https://plugins.svn.wordpress.org/shortpixel-adaptive-images/trunk/changelog.txt" target="_blank">changelog.txt</a> file inside the plugin archive.

== Upgrade Notice ==

= 2.0 =
ShortPixel Adaptive Images version 2.0 is a major upgrade and it comes with some new tools that help you manage the settings and the optimized images. Please note that following this upgrade, the plugin settings will be stored in a different way, therefore please also make a full site backup, update your theme and extensions, and review update best practices before upgrading.
= 2.0:END =

= 2.1 =
ShortPixel Adaptive Images version 2.1 is a major upgrade and it comes with some new tools that help you manage the settings and the optimized images. Please note that following version 2.0, the plugin settings will be stored in a different way, therefore please also make a full site backup, update your theme and extensions, and review update best practices before upgrading.
= 2.1:END =

= 3.0.0 =
SPAI 3 is a major update and it comes with a completely new Adaptive Images engine based on pure JS (no jQuery required anymore). Enable it from the Behavior tab in Settings -> ShortPIxel AI.
= 3.0.0:END =
