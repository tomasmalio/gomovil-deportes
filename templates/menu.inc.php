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
		<li><a href="#{{ item.url }}" data-toggle="modal">{{ item.title }}</a></li>
		{% endif %}
		{% else %}
		<li><a href="/{{ item.url }}">{{ item.title }}</a></li>
		{% endif %}
		{% endfor %}
	</ul>
</div>