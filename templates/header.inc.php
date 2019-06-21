<!-- Header -->
<header class="fixed-top">
	<div class="container-fluid">
		<nav class="navbar navbar-menu navbar-expand-lg navbar-light">
			<div class="navbar-header">
				<a class="navbar-brand" href="/"><img src="/images/header/{{ logo }}" name="logo" title="" alt=""></a>
			</div>
			<div class="button-menu pull-right sb-right d-xl-none d-xl-none d-md-none">
				<button class="sb-toggle-right" aria-label="menu">
					<span class="icon-bars">&#9776;</span> </span>
				</button>
			</div>
			<div class="collapse navbar-collapse navbar-buttons">
				<script type="application/javascript">
					$('.dropdown').hover(
						function() {
							$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
						}, 
						function() {
							$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
							}
						);
						$('.dropdown-menu').hover(
							function() {
							$(this).stop(true, true);
						},
						function() {
							$(this).stop(true, true).delay(200).fadeOut();
						}
					);
				</script>
				<!-- ml-auto-->
				<ul class="nav navbar-nav h-100">
					{% for item in menu %}
					{% if item.submenu is empty %}
					<li><a href="{{ item.url }}">{{ item.title }}</a></li>
					{% else %}
					<li class="dropdown">
						<a data-toggle="dropdown" href="#">{{ item.title }}</a>
						{% if item.submenu is not empty %}
						<!-- Submenu -->
						<div class="dropdown-menu">
							{% set contentSubmenu = '' %}
							<ul class="dropdown-menu-submenu float-left">
								{% for submenu in item.submenu %}
								{% if submenu.display is empty and submenu.items is not empty %}
								{% set contentSubmenu = submenu.items %}
								<li class="item"><a href="{{ item.url }}">Portada</a></li>
								{% endif %}
								{% if submenu.display %}
								<li class="item"><a href="{{ item.url }}/{{ submenu.url }}">{{ submenu.title }}</a></li>
								{% endif %}
								{% endfor %}
							</ul>
							{% if contentSubmenu is not empty %}
							<!-- Content / Submenu -->
							<div class="dropdown-menu-content football float-left">
								<!-- Ligas -->
								{% for key, content in contentSubmenu %}
								<div class="row">
									<div class="col-12">
										<h2>{{ key }}</h2>
									</div>
								</div>
								<div class="row">
									<div class="col-12 leagues">
										<ul class="list-leagues">
											{% for k, each in content %}
											<li>
												<a href="#" title="Torneo Descentralizado Perú">
													<div class="card">
														<div class="card-img">
															<img src="{{ each.image }}">
														</div>
													</div>
													<h5 class="card-title">
														{% if each.name[country] is empty %}
														{{ each.name.default }}
														{% else %}
														{{ each.name[country] }}
														{% endif %}
													</h5>
												</a>
											</li>
											{% endfor %}
										</ul>
									</div>
								</div>
								{% endfor %}
							</div>
							<!-- Eof content / Submenu -->
							{% endif %}
						</div>
						<!-- Eof submenu -->
						{% endif %}
					</li>
					{% endif %}
					{% endfor %}
				</ul>
			</div>
		</nav>
		
	</div>
</header>
<!-- Eof Header -->