<?php

$properties = array();

$tmp = array(
    'tvName' => array(
        'type' => 'textfield',
        'value' => 'visualFilter',
    ),
    'mode' => array(
        'type' => 'list',
        'options' => array(
            array('text' => 'filters', 'value' => 'filters'),
            array('text' => 'aliases', 'value' => 'aliases'),
        ),
        'value' => 'filters'
    ),
    'sortby' => array(
		'type' => 'textfield',
		'value' => 'priority',
	),
	'sortdir' => array(
		'type' => 'list',
		'options' => array(
			array('text' => 'ASC', 'value' => 'ASC'),
			array('text' => 'DESC', 'value' => 'DESC'),
		),
		'value' => 'ASC'
	),
    'outputSeparator' => array(
        'type' => 'textfield',
        'value' => ',',
    ),
	'toPlaceholder' => array(
		'type' => 'combo-boolean',
		'value' => false,
	),
);

foreach ($tmp as $k => $v) {
	$properties[] = array_merge(
		array(
			'name' => $k,
			'desc' => PKG_NAME_LOWER . '_prop_' . $k,
			'lexicon' => PKG_NAME_LOWER . ':properties',
		), $v
	);
}

return $properties;