# Athena Shortcodes Plugin #



## Description ##

Provides shortcodes that support the use of the [Athena Framework](https://github.com/UCF/Athena-Framework).


## Installation ##

### Manual Installation ###
1. Upload the plugin files (unzipped) to the `/wp-content/plugins` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the "Plugins" screen in WordPress

### WP CLI Installation ###
1. `$ wp plugin install --activate https://github.com/UCF/Athena-Shortcodes-Plugin/archive/master.zip`.  See [WP-CLI Docs](http://wp-cli.org/commands/plugin/install/) for more command options.


## Changelog ##

### 0.3.0 ###
Enhancements:
* Added shortcodes for alerts: `[alert]`, `[alert-heading]` and `[alert-link]`.
* Updated npm packages list.
* Upgraded admin css to latest verion of Athena Framework.

### 0.2.0 ###
Enhancements:
* Added `[media-background-container]` and `[media-background]` shortcodes. `<img>` and `<video>` media backgrounds are currently supported.
* Added `[block-link]` shortcode for easier inclusion of generic block-level links in WordPress content.
* Added `[icon]` shortcode for easier inclusion of font icons. The shortcode is library-agnostic/relevant classes for FontAwesome, etc will need to be added to the `class` attribute wherever this shortcode is used.
* Added WP Shortcode Interface group name support for existing shortcodes.
* Upgraded admin css to latest version of Athena Framework.

### 0.1.0 ###
* Initial release


## Upgrade Notice ##

n/a


## Installation Requirements ##

None


## Development & Contributing ##

NOTE: this plugin's readme.md file is automatically generated.  Please only make modifications to the readme.txt file, and make sure the `gulp readme` command has been run before committing readme changes.
