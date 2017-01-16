# phpBB Pages Extension

This is the repository for the development of the phpBB Pages Extension.

[![Build Status](https://travis-ci.org/phpbb-extensions/pages.svg)](https://travis-ci.org/phpbb-extensions/pages)

## Install

1. [Download the latest validated release](https://www.phpbb.com/customise/db/extension/pages/).
2. Unzip the downloaded release and copy it to the `ext` directory of your phpBB board.
3. Navigate in the ACP to `Customise -> Manage extensions`.
4. Look for `Pages` under the Disabled Extensions list, and click its `Enable` link.
5. Set up and configure Pages by navigating in the ACP to `Extensions` -> `Pages`.

## Uninstall

1. Navigate in the ACP to `Customise -> Extension Management -> Extensions`.
2. Look for `Pages` under the Enabled Extensions list, and click its `Disable` link.
3. To permanently uninstall, click `Delete Data` and then delete the `/ext/phpbb/pages` directory.

## Support

* **Important: Only official release versions validated by the phpBB Extensions Team should be installed on a live forum. Pre-release (beta, RC) versions downloaded from this repository are only to be used for testing on offline/development forums and are not officially supported.**
* Report bugs and other issues to our [Issue Tracker](https://github.com/phpbb-extensions/pages/issues).
* Support requests should be posted and discussed in the [Pages topic at phpBB.com](https://www.phpbb.com/customise/db/extension/pages/support).

## Translations

* Translations should be posted to the [Pages topic at phpBB.com](https://www.phpbb.com/customise/db/extension/pages/support/topic/130741). We accept pull requests for translation corrections, but we do not accept pull requests for new translations.

## Customising Pages

[View the Wiki](https://github.com/phpbb-extensions/pages/wiki/Customising-Pages) for guides to customise page link icons and page templates.

## Converting from a MOD

Pages can convert/import data from [Static Pages MOD 1.0.3](https://www.phpbb.com/customise/db/mod/static_pages). If Pages finds the Static Pages MOD data in your database, it will automagically convert it when you enable Pages. To complete the transition, we recommend you review the Static Pages MOD's install instructions in order to remove the file-edits to `constants.php` and delete all of the included files the MOD added to your forum.

Note: Pages will keep a backup of the Static Pages MOD data in a database table named `pages_mod_backup`. Pages will never delete or alter this backup table. Pages has not been tested with any other similar MODs.

## License
[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)
