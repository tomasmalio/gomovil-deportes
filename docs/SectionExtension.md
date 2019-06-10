# Section Extension
When you create a section you can add extensions and modify a lot of things. Let's look what we can do it so you can customize.

## Options
In the moment you create an extension you can define a lot of things inside the **options** of each so you must understand that it's going to receive a **JSON**. In the next example you can see that the extension receive the number of items you want to display in dektop and mobile. Then we set true for desktop and mobile the slider:

```sql
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
```sql
{
	"variable-color": "#ffffff",
	"variable-padding": "10px",
	"variable-margin": "10px",
	"font-size-variable": "14pt"
}
```