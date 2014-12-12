<?php
return  [
	'modules' => [
		'Developer\DAL',
		'Developer\Model',
		'Developer\ChkAccess',
		'GftHint\Core\User',
		'GftHint\Core\Gift',
		'GftHint\Infrastructure\Shared',
		'GftHint\Infrastructure\User',
		'GftHint\Di\Web',
		'GftHint\Web\Shared',
		'GftHint\Web\Main',
		'GftHint\Web\Account',
	],

	'module_listener_options' => [
		'module_paths' => [
			'./vendor',
			'./solution',
			'Developer\\*' => './developer/module'
		],

		'config_glob_paths' => [
			'config/autoload/{,*.}{global,local}.php',
		]
	]
];