# phpBB Pages Extension

This is the repository for the development of the phpBB Pages Extension.

[![Build Status](https://travis-ci.org/phpbb-extensions/pages.png)](https://travis-ci.org/phpbb-extensions/pages)

## Quick Install
You can install this on the latest release of phpBB 3.1 by following the steps below:

1. [Download the latest release](https://github.com/phpbb-extensions/pages/releases).
2. Unzip the downloaded release, and change the name of the folder to `pages`.
3. In the `ext` directory of your phpBB board, create a new directory named `phpbb` (if it does not already exist).
4. Copy the `pages` directory to `phpBB/ext/phpbb/` (if done correctly, you'll have the main composer JSON file at (your forum root)/ext/phpbb/pages/composer.json).
5. Navigate in the ACP to `Customise -> Manage extensions`.
6. Look for `Pages` under the Disabled Extensions list, and click its `Enable` link.
7. Set up and configure Pages by navigating in the ACP to `Extensions` -> `Pages`.

## Uninstall

1. Navigate in the ACP to `Customise -> Extension Management -> Extensions`.
2. Look for `Pages` under the Enabled Extensions list, and click its `Disable` link.
3. To permanently uninstall, click `Delete Data` and then delete the `/ext/phpbb/pages` directory.

## Support

* **Important: Only official release versions validated by the phpBB Extensions Team should be installed on a live forum. Pre-release (beta, RC) versions downloaded from this repository are only to be used for testing on offline/development forums and are not officially supported.**
* Report bugs and other issues to our [Issue Tracker](https://github.com/phpbb-extensions/pages/issues).
* Support requests should be posted and discussed in the [Pages topic at phpBB.com](https://www.phpbb.com/customise/db/extension/pages/support).

## Customising Pages

### Custom Page Link Icons

Whether you want a more personalised look or need icons that will work with each of your installed styles' color palettes, it's easy to add your own unique custom page link icons.

To get started, your custom icons must follow a specific naming structure of the form: `pages_route.gif` wherein `route` must be the name of the route defined for the page the icon is associated with. For example, a page with the route `foobar` would use the icon `pages_foobar.gif`. The image must also be a GIF.

The custom icons should be kept in phpBB's style/*/theme/images directories, for example: `phpbb/styles/prosilver/theme/images/pages_foobar.gif`. You should add your custom icon to every style installed on your board (you can design different icons for each style if necessary). If Pages can't find an icon it will fallback to its default icon.

Alternatively, style authors and other experienced users that don't want to use individual image files for icons, can use the CSS classes which are added to the page links automatically. These classes allow you to change the styling of the link (including icons) to replace the default icon, using CSS. These classes follow the naming structure of the form: `icon-page-route` wherein `route` is the name of the route as defined in the extension's ACP module.

### Custom Page Templates

Custom page templates offer tremendous flexibility for the appearance and content of your Pages. They can be used to bring additional HTML content, javascript and CSS to your Pages or to better integrate your Pages with other styles installed on your board.

Page templates must follow a naming structure of the form: `pages_*.html` where `*` can be any name you want. Pages ships with two templates that can be used as a basis for your custom templates, and they have helpful comments in them about including external javascript and CSS files. All available page templates will appear in the ACP when you create/edit pages where they can be assigned to a page.

Because these are actual templates, just like any other style template files, you can use phpBB's template syntax (or TWIG) in them as well, to add events, include additional template files, and render or display content based on available template variables. They can NOT, however, be used to execute PHP code.

Page templates follow phpBB's style inheritance. A page template designed for Prosilver and Prosilver-based styles need only be added to Prosilver's template directory. However, you can add other versions of that page template to other styles too, if needed (such as to match the look of the specific style). Page templates found in child styles of Prosilver or subsilver2 will override page templates inherited from the parent style. The only caveat is that you can not override the two page templates that ship with this extension, meaning you can not use `pages_default.html` or `pages_blank.html` for names of your custom page templates. Additionally, custom page templates should be kept in phpBB's style/*/template directories; not in the Pages extension's style directories.

We recommend keeping custom icons and templates stored in phpBB's style directories rather than in Pages' style directories, as this prevents accidental deletion of your custom files whenever the Pages extension is updated.

## Converting from a MOD

Pages can convert/import data from [Static Pages MOD 1.0.3](https://www.phpbb.com/customise/db/mod/static_pages). If Pages finds the Static Pages MOD data in your database, it will automagically convert it when you enable Pages. To complete the transition, we recommend you review the Static Pages MOD's install instructions in order to remove the file-edits to `constants.php` and delete all of the included files the MOD added to your forum.

Note: Pages will keep a backup of the Static Pages MOD data in a database table named `pages_mod_backup`. Pages will never delete or alter this backup table. Pages has not been tested with any other similar MODs.

## License
[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)
