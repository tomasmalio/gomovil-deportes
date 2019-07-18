<ul class="menu-responsive">
	<li class="logo"><a href="/"><img src="/images/header/{{ logo }}" name="logo" title="" alt=""></a></li>
	{% for item in menu %}
	<li><a href="/{{ item.url }}">{{ item.title }}</a></li>
	{% endfor %}
</ul>