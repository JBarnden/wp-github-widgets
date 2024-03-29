# Widget Shortcodes for Github
**Author: [James Barnden](https://jamqes.com)**

![GitHub Buttons](./docs_images/buttons.png "GitHub Buttons")

## Description
Lightweight widget shortcodes to display GitHub buttons and gists on your blog. Includes shortcode for embedding GitHub hosted gists and buttons for:

- Follow
- Watch
- Star
- Fork
- Download
- Issue

The plugin implements [ntkme's 'github-buttons'](https://github.com/ntkme/github-buttons) and GitHub's gist display as shortcodes.

## Installation
- Upload the `widget-shortcodes-gh` directory to your plugins directory `wp-content/plugins`.
- Activate the plugin through the 'Plugins' menu in WordPress

## Usage

### GitHub Follow Button
Add the `[Github_User_Button user='JBarnden']` shortcode in your content and replace `JBarnden` with the desired GitHub username.

#### Optional Additional Parameters
- `size`: makes the button slightly bigger, can be set to `large` or `small`.  Default value is `small`.
- `show_count`: show current number of followers, can be set to `true` or `false`.  Default value is false.

#### Example
`[Github_User_Button user='JBarnden' size='large' show_count='true']`

#### Screenshot
![GitHub Buttons](./docs_images/buttons.png "GitHub Buttons")

### GitHub Repo Buttons
Add the `[Github_Repo_Button user='JBarnden' repo='MyRepo']` shortcode in your content, replacing `JBarnden` with the desired GitHub username and `MyRepo` with the desired repo belonging to the specified user.

#### Optional Additional Parameters
- `type`: changes button behaviour/type, can be set to `watch`, `star`, `fork`, `issue` or `download`.  Default value is `star`.
- `size`: makes the button slightly bigger, can be set to `large` or `small`.  Default value is `small`.
- `show_count`: show current number of followers, can be set to `true` or `false`.  Default value is false.
- `icon`: can be used to set the icon to standard GitHub icon, can be set to `standard` or `type_default`. Default value is `type_default`.

#### Example
`[Github_Repo_Button user='JBarnden' repo='wp-github-widgets' size='large' show_count='true']`

### Display GitHub Gist
Add the `[Gist]gist_id[/Gist]` where `gist_id` is replaced with the id of the desired Gist.

#### Example
`[Gist]cee89b8a3600c50b7e50fa4870403069[/Gist]`

#### Screenshot
![Gist](./docs_images/gist.png "Gist")

## Feature Requests and Contributions
Please submit feature requests and contributions via the issues section of the Repository.  If you feel like improving the plugin, pull requests are both welcome and appreciated.
