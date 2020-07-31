# Changelog

## Version 2.x (for phpBB 3.2)

## 2.0.4 - 2020-03-29

- New option to display page's titles before the site name in browser windows.
- Fixed links to FontAwesome's web site.
- Removed Subsilver2 style and support.

### 2.0.3 - 2018-03-14

- Fixed HTML syntax errors in the ACP pages.

### 2.0.2 - 2017-06-28

- Fixed an HTML output error in the "Quick Links Menu Bottom" page link location.
- Fixed a migration issue.

### 2.0.1 - 2017-05-28

- Added support for using Font Awesome icons with page links.
- Updated all templates to now use Twig syntax.
- Fixed some minor coding and language issues.
- Added Croatian (formal) language pack
- Added Slovak language pack

### 2.0.0 - 2017-01-16

- Updated for phpBB 3.2 (continue using the 1.x branch for phpBB 3.1.x)
- New minimum requirements: phpBB 3.2.0 and PHP 5.4
- New dynamic routing has allowed us to remove the `/page/` requirement from page URLs. This means your pages can be accessed directly: `forum.com/pagename` (the old method still works as well: `forum.com/page/pagename`)

## Version 1.x (for phpBB 3.1)

### 1.0.5 - 2016-11-10

- Fix the Brazilian Portuguese language (renamed from pt-br to pt_br)
- Fix posted images to fit within the page area and not overflow
- Minor code and HTML improvements
- Added German language pack

### 1.0.4 - 2016-01-17

- Added a feature where route names are auto-suggested based on the page title
- Fixed an issue that prevented pages from being updated on MSSQL systems
- Fixed some minor coding and language issues
- Added Brazilian Portuguese language pack
- Added Czech language pack
- Added Mandarin Chinese (Simplified Script) language pack
- Added Russian language pack

### 1.0.3 - 2015-06-14

- Inaccessible pages will corectly send 404 status codes
- Removed edit time limitations when creating pages
- Removed maximum character limitations when creating pages
- Fixed an issue that would display unwanted XML characters in phpBB 3.2 environments
- Minor coding improvements
- Added Arabic language pack
- Added Croatian language pack
- Added German (casual) language pack
- Added German (formal) language pack
- Added Italian language pack
- Added Polish language pack
- Require phpBB 3.1.3

### 1.0.2 - 2015-01-04

- Fixed some very minor coding issues
- Switched to Titania hosted version checking

### 1.0.1 - 2014-11-28

- Make Page URL Route explanation easier to understand
- Renamed Pages template events with vendor and extension names prefixes.
	- `acp_pages_before_editor` is now `phpbb_pages_acp_before_editor`
	- `pages_after_page_content` is now `phpbb_pages_after_page_content`
- Updated some internal tests and comments
- Updated routing.yml option `pattern` to `path`
- Added Dutch language pack
- Added French language pack
- Added Portuguese language pack
- Added Spanish language pack
- Added Swedish language pack

### 1.0.0 - 2014-10-23

- First release
