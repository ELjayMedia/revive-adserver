# EljayMedia admin theme

The EljayMedia look for the Revive Adserver admin at ads.eljaymedia.com is built as a Revive **plugin**. It does not edit Revive's own files.

```
plugins_repo/eljayMediaTheme/
├── plugins/etc/eljayMediaTheme.xml              package manifest
├── plugins/etc/emAdminTheme/emAdminTheme.xml    group manifest (hook: registerUiListeners)
└── www/admin/plugins/emAdminTheme/
    ├── emAdminTheme.class.php                   adds the stylesheet to every admin page
    ├── css/eljaymedia.css                       the theme (EljayMedia tokens, overrides only)
    └── images/                                  official logo files
```

## How it works

Revive calls the `beforePageHeader` UI hook before every admin page renders. The plugin listens for that hook and registers `css/eljaymedia.css`, which loads **after** Revive's own stylesheets and overrides them. This uses Revive's documented plugin API, so nothing in `lib/`, `www/admin/assets/` or the templates is modified.

## Why upgrades won't remove it

| What happens during an upgrade | What happens to the theme |
| --- | --- |
| A new Revive release replaces the core files | The theme isn't in the core files, so nothing is overwritten |
| Revive's upgrade guide has you copy `plugins/`, `www/admin/plugins/` and `var/` from the old install | The installed theme is copied across with them |
| Upstream changes to the admin CSS | The theme still loads last, so its rules still apply |
| You merge upstream Revive into this fork | `plugins_repo/eljayMediaTheme/` and this file are new paths, so the merge never conflicts on them |

If a future Revive release renames admin elements (for example `#oaHeader` or `#secondLevelNavigation`), parts of the theme may stop matching and fall back to the stock look. Nothing breaks. Update the selectors in `eljaymedia.css` and bump the version (see below).

## Install

1. Build the zip:

   ```bash
   cd plugins_repo && sh zipkg.sh eljayMediaTheme
   ```

2. In the Revive admin, go to **Plugins → Add new plugin**, upload `plugins_repo/eljayMediaTheme.zip` and enable it.

To turn the theme off, disable the plugin. The stock UI comes straight back.

## Upgrading Revive

1. Follow the official upgrade guide (https://www.revive-adserver.com/support/upgrading/). Copy `var/` (config), `plugins/` and `www/admin/plugins/` from the old install into the new one.
2. Run the upgrade wizard. The theme stays installed and enabled.
3. If you deploy from this fork, merge the upstream release tag into your branch. The theme is in its own folder, so there are no conflicts.

## Changing the theme

- Edit `www/admin/plugins/emAdminTheme/css/eljaymedia.css`. Colours, fonts and radii are CSS variables in `:root` at the top of the file.
- Bump `VERSION` in `emAdminTheme.class.php` and `<version>` in both XML manifests. The version is added to the stylesheet URL, so browsers don't keep a cached copy.
- Rebuild the zip and upload it again, or copy the CSS straight to `www/admin/plugins/emAdminTheme/css/` on the server.

## Design reference

The screen designs this theme follows (dashboard, campaigns, banner editor, sign in) are on the design canvas:
https://claude.ai/artifact/D9wuh49NgKuTVkG3CNPoKT
