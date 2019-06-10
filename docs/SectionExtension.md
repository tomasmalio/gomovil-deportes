# Section Extension
When you create a section you can add extensions and modify a lot of things. Let's look what we can do it so you can customize.

## Options
In the moment you create an extension you can define a lot of things inside the **options** of each so you must understand that it's going to receive a **JSON**. In the next example you can see that the extension receive the number of items you want to display in dektop and mobile. Then we set true for desktop and mobile the slider:

```JSON
{
	"items": {
		"desktop": 8,
		"mobile": 8
	},
	"slider": {
		"desktop": {
			"display": true
		},
		"mobile": {
			"display": true
		}
	}
}
```

## Styles
When you want to modify the styles of your extension you can include a **JSON** code in the **styles** column. Your JSON must be write like this:
```JSON
{
	"variable-color": "#ffffff",
	"variable-padding": "10px",
	"variable-margin": "10px",
	"font-size-variable": "14pt"
}
```

## Content
This is of the most important thing of creating a extension in a section. The platform allows you to define different kind of things in the content in **JSON** format.

```JSON
{
	"words": {
		"title": "Tendencias"
	},
	"country_code": {@countryCode},
	"trending": true,
	"limit": "10"
}
```

As you can see there's a **{@countryCode}** inside the **JSON** an it's a variable that the platform replace it automatically when the extension is call.

List of variables that you can use:
* {@Section}
* {@SubSection}
* {@SubSubSection}
* {@filter1}
* {@countryName}
* {@countryCode}