EncodeSans Font Bundle
======================

The EncodeSansBundle loads the [EncodeSans](https://www.fontsquirrel.com/fonts/encode-sans) font families into your symfony project.

If your project uses the [AsseticBundle](http://symfony.com/doc/current/assetic/asset_management.html), the fonts are made available as [assetic named assets](http://symfony.com/doc/current/assetic/asset_management.html#using-named-assets).

Installation
------------

Update the project's `composer.json` file as follows:

```
{
	"repositories": [
		{
			"type": "composer",
			"url": "http://satis.united-asian.com/fonts"
		}
	],
	require: {
		"fonts/encode-sans": "dev-master"
	}
}
```

Configuration
-------------

Define the bundle's `mode` via its configuration. The default value is `individual`.

```yml
encode_sans:
	mode: families|individual
```

Usage
-----

### `families` mode

In `families` mode, 5 **Encode Sans** font families are defined, each available in 9 different weights.

Each font family is defined in a separate stylesheet and is represented by a different assetic named asset:

* Encode Sans: encode-sans-all.css (`@encode-sans`)
* Encode Sans Condensed: condensed/encode-sans-condensed-all.css (`@encode_sans_condensed`)
* Encode Sans Compressed: compressed/encode-sans-compressed-all.css (`@encode_sans_compressed`)
* Encode Sans Narrow: narrow/encode-sans-narrow-all.css (`@encode_sans_narrow`)
* Encode Sans Wide: wide/encode-sans-wide-all.css (`@encode_sans_wide`)

Include the relevant stylesheet(s) in your page template using one of the 3 methods below. In this example we load the `Encode Sans`, `Encode Sans Narrow` and `Encode Sans Wide` font families:

#### Direct include
```html
<link href="bundles/encodesans/css/encode-sans-all.css" rel="stylesheet" type="text/css">
<link href="bundles/encodesans/css/narrow/encode-sans-narrow-all.css" rel="stylesheet" type="text/css">
<link href="bundles/encodesans/css/wide/encode-sans-wide-all.css" rel="stylesheet" type="text/css">
```

#### Use assetic's `javascripts` twig tag

```html
{% stylesheets filter="cssrewrite"
    "bundles/encodesans/css/encode-sans.css"
    "bundles/encodesans/css/encode-sans-narrow.css"
    "bundles/encodesans/css/encode-sans-wide.css"
%}
{% endstylesheets %}
```

#### Use assetic's `javascripts` twig tag with the bundle's formula

```html
{% stylesheets filter="cssrewrite"
    "@encode_sans"
    "@encode_sans_narrow"
    "@encode_sans_wide"
%}
{% endstylesheets %}
```

In your stylesheet, apply the font to the elements of you choice via the `font-*` CSS rules, as per the example below:

```css
body {
	font-family: "Encode Sans", sans-serif;
}

h1 {
	font-family: "Encode Sans Wide", sans-serif;
	font-weight: 600;
}

h3 {
	font-family: "Encode Sans Narrow", sans-serif;
}
```

### `individual` mode

In `individual` mode, seperate fonts are loaded for each combination of widget and weight. In most cases, your app will only use a subset of all the available font's weights. Rather than load them all, this mode allows you to load only what you require. This is the bundle's default mode.

Each combination of font width and font weight represents a different font and is defined in a separate stylesheet; each is represented by a different assetic named asset.

* Normal width:
	* Encode Sans: normal/encode-sans_regular.css (`@encode_sans`)
	* Encode Sans Medium: normal/encode-sans-medium.css (`@encode_sans_medium`)
	* Encode Sans SemiBold: normal/encode-sans-semibold.css (`@encode_sans_semibold`)
	* Encode Sans Bold: normal/encode-sans-bold.css (`@encode_sans_bold`)
	* Encode Sans ExtraBold: normal/encode-sans-extrabold.css (`@encode_sans_extrabold`)
	* Encode Sans Black: normal/encode-sans-black.css (`@encode_sans_black`)
	* Encode Sans Light: normal/encode-sans-light.css (`@encode_sans_light`)
	* Encode Sans ExtraLight: normal/encode-sans-extralight.css (`@encode_sans_extralight`)
	* Encode Sans Thin: normal/encode-sans-thin.css (`@encode_sans_thin`)
* Condensed:
	* Encode Sans Condensed: condensed/encode-sans-condensed-regular.css (`@encode_sans_condensed`)
	* Encode Sans Condensed Medium: condensed/encode-sans-condensed-medium.css (`@encode_sans_condensed_medium`)
	* Encode Sans Condensed SemiBold: condensed/encode-sans-condensed-semibold.css (`@encode_sans_condensed_semibold`)
	* Encode Sans Condensed Bold: condensed/encode-sans-condensed-bold.css (`@encode_sans_condensed_bold`)
	* Encode Sans Condensed ExtraBold: condensed/encode-sans-condensed-extrabold.css (`@encode_sans_condensed_extrabold`)
	* Encode Sans Condensed Black: condensed/encode-sans-condensed-black.css (`@encode_sans_condensed_black`)
	* Encode Sans Condensed Light: condensed/encode-sans-condensed-light.css (`@encode_sans_condensed_light`)
	* Encode Sans Condensed ExtraLight: condensed/encode-sans-condensed-extralight.css (`@encode_sans_condensed-extralight`)
	* Encode Sans Condensed Thin: condensed/encode-sans-condensed-thin.css (`@encode_sans_condensed_thin`)
* Compressed:
	* Encode Sans Compressed: compressed/encode-sans-compressed-regular.css (`@encode_sans_compresssed`)
	* Encode Sans Compressed Medium: compressed/encode-sans-compressed-medium.css (`@encode_sans_compresssed_medium`)
	* Encode Sans Compressed SemiBold: compressed/encode-sans-compressed-semibold.css (`@encode_sans_compresssed_semibold`)
	* Encode Sans Compressed Bold: compressed/encode-sans-compressed-bold.css (`@encode_sans_compresssed_bold`)
	* Encode Sans Compressed ExtraBold: compressed/encode-sans-compressed-extrabold.css (`@encode_sans_compresssed_extrabold`)
	* Encode Sans Compressed Black: compressed/encode-sans-compressed-black.css (`@encode_sans_compresssed_black`)
	* Encode Sans Compressed Light: compressed/encode-sans-compressed-light.css (`@encode_sans_compresssed_light`)
	* Encode Sans Compressed ExtraLight: compressed/encode-sans-compressed-extralight.css (`@encode_sans_compresssed_extralight`)
	* Encode Sans Compressed Thin: compressed/encode-sans-compressed-thin.css (`@encode_sans_compresssed_thin`)
* Narrow:
	* Encode Sans Narrow: narrow/encode-sans-narrow-regular.css (`@encode_sans_narrow`)
	* Encode Sans Narrow Medium: narrow/encode-sans-narrow-medium.css (`@encode_sans_narrow_medium`)
	* Encode Sans Narrow SemiBold: narrow/encode-sans-narrow-semibold.css (`@encode_sans_narrow_semibold`)
	* Encode Sans Narrow Bold: narrow/encode-sans-narrow-bold.css (`@encode_sans_narrow_bold`)
	* Encode Sans Narrow ExtraBold: narrow/encode-sans-narrow-extrabold.css (`@encode_sans_narrow_extrabold`)
	* Encode Sans Narrow Black: narrow/encode-sans-narrow-black.css (`@encode_sans_narrow_black`)
	* Encode Sans Narrow Light: narrow/encode-sans-narrow-light.css (`@encode_sans_narrow_light`)
	* Encode Sans Narrow ExtraLight: narrow/encode-sans-narrow-extralight.css (`@encode_sans_narrow_extralight`)
	* Encode Sans Narrow Thin: narrow/encode-sans-narrow-thin.css (`@encode_sans_narrow_thin`)
* Wide:
	* Encode Sans Wide: wide/encode-sans-wide-regular.css (`@encode_sans_wide`)
	* Encode Sans Wide Medium: wide/encode-sans-wide-medium.css (`@encode_sans_wide_medium`)
	* Encode Sans Wide SemiBold: wide/encode-sans-wide-semibold.css (`@encode_sans_wide_semibold`)
	* Encode Sans Wide Bold: wide/encode-sans-wide-bold.css (`@encode_sans_wide_bold`)
	* Encode Sans Wide ExtraBold: wide/encode-sans-wide-extrabold.css (`@encode_sans_wide_extrabold`)
	* Encode Sans Wide Black: wide/encode-sans-wide-black.css (`@encode_sans_wide_black`)
	* Encode Sans Wide Light: wide/encode-sans-wide-light.css (`@encode_sans_wide_light`)
	* Encode Sans Wide ExtraLight: wide/encode-sans-wide-extralight.css (`@encode_sans_wide_extralight`)
	* Encode Sans Wide Thin: wide/encode-sans-wide-thin.css (`@encode_sans_wide_thin`)

Include the relevant stylesheets into your template as per the example below. In this case we are loading the `Encode Sans`, `Encode Sans Bold` and `Encode Sans Wide Black` fonts.

#### Direct include
```html
<link href="bundles/encodesans/css/encode-sans.css" rel="stylesheet" type="text/css">
<link href="bundles/encodesans/css/encode-sans-bold.css" rel="stylesheet" type="text/css">
<link href="bundles/encodesans/css/wide/encode-sans-wide-black.css" rel="stylesheet" type="text/css">
```

#### Use assetic's `javascripts` twig tag

```html
{% stylesheets filter="cssrewrite"
    "bundles/encodesans/css/encode-sans.css"
    "bundles/encodesans/css/encode-sans-bold.css"
    "bundles/encodesans/css/wide/encode-sans-wide-black.css"
%}
{% endstylesheets %}
```

#### Use assetic's `javascripts` twig tag with the bundle's formula

```html
{% stylesheets filter="cssrewrite"
    "@encode_sans"
    "@encode_sans_bold"
    "@encode_sans_wide_black"
%}
{% endstylesheets %}
```

In your stylesheet, apply the font to the elements of you choice via the `font-*` CSS rules, as per the example below. Make sure to use the appropriate font name for each weight. There is no need to specify the `font-weight`, since it is already part of the font definition.

```css
body {
	font-family: "Encode Sans", sans-serif;
}

.jumbotron h1 {
	font-family: "Encode Sans Wide Black", sans-serif;
}

strong {
	font-family: "Encode Sans Bold", sans-serif;
}
```
