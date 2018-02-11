<?php
return[
	'module' => 'backend',
	'controllerNamespace' => 'backend\controllers',
	'routes' =>
		[
			'login' => ['controller' => 'user', 'action' => 'login'],
			'logout' => ['controller' => 'user', 'action' => 'logout'],
			//'^(?P<action>[a-z]+)$' => ['controller' => 'user'],
			//default routes
			'^$' => ['controller' => 'site', 'action' => 'index'],
			'^(?P<controller>[a-z]+)/?(?P<action>[a-z]+)?$' => ''

		]

];