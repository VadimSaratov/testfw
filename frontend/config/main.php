<?php
return[
	'module' => 'frontend',
	'controllerNamespace' => 'frontend\controllers',
	'routes' =>
	[
		'^user/(?P<action>[a-z]+)/(?P<alias>[a-z]+)$' => ['controller' => 'user'],
		'^user/(?P<alias>[a-z]+)$' => ['controller' => 'user', 'action' => 'view'],
		//default routes
		'^$' => ['controller' => 'site', 'action' => 'index'],
		'^(?P<controller>[a-z]+)/?(?P<action>[a-z]+)?$' => ''

	]

];