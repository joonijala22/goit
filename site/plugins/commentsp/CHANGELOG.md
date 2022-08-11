# Changelog

## [1.5.5] - 2019-10-03
### Changed
- Fixed the can't create folder error, ->createChild([]) needed specific key names
- Localization support
- Changed PHP SESSION to Kirby v3 Session
- Updated README

### Removed
- Removed entire custom field code, because it did not work in kirby v3 and i have no time to maintain it

## [1.5.4] - 2019-05-14
### Changed
- Fixed the error when creating a page. This was due to not working Kirby v2-code

## [1.5.3] - 2019-04-28
### Added
- Basic support for Kirby v3 - Note that I didn't test all functionalities

### Changed
- c::get() got ->option()
- date() got date()->toDate()
- page creation changed from comments page->children->()->create() to ->createChild([])

### Removed
- Custom Fields are not working right now, because it is not working with Kirby v3
