<div class="sb-slidebar sb-right">
	<ul class="menu-responsive">
		<li class="logo"><a href="/"><img src="/images/header/{{ logo }}" name="logo" title="" alt=""></a></li>
		{% for item in menu %}

		{% set array = [] %}
		{% if item.age_control is not empty %}
		{% if age_control == true %} 
		<li><a href="/{{ item.url }}">{{ item.title }}</a></li>
		{% else %}
		{% set array = array|merge([{url: item.url}]) %}
		<li data-target="#{{ item.url }}" data-toggle="modal">{{ item.title }}</li>
		{% endif %}
		{% else %}
		<li><a href="/{{ item.url }}">{{ item.title }}</a></li>
		{% endif %}
		{% endfor %}
	</ul>
</div>
<!-- {% if array is not empty %}
{% for item in array %}
<div id="{{ item.url }}" class="modal hide fade modal-age-control" tabindex="-1">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		</div>
		<div class="modal-body">
			<div class="image-age-control">
				<img src="/images/header/modal/imge-age-control.svg" name="agecontrol" title="" alt="">
			</div>
			<p>Para acceder a esta sección, tiene que ser mayor de 18 años.</p>
		</div>
		<div class="modal-footer">
			<form action="/" method="post">
				<input type="hidden" name="url" value="{{ item.url }}">
				<input type="hidden" name="ageControl" value="1">
				<button type="button" class="btn-close-age-control" data-dismiss="modal" aria-hidden="true">Volver</button>
				<button type="submit" name="submit" class="btn-age-control">Soy mayor de 18 años</button>
			</form>
		</div>
	</div>
</div>
{% endfor %}
{% endif %} -->