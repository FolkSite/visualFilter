<?php
$xpdo_meta_map['vfCategoryFilter']= array (
  'package' => 'visualfilter',
  'version' => '1.1',
  'table' => 'vf_category_filters',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'category_id' => 0,
    'filter_id' => 0,
    'priority' => 0,
    'collapse' => '',
  ),
  'fieldMeta' => 
  array (
    'category_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'filter_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'priority' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'collapse' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '1',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
  ),
  'aggregates' => 
  array (
    'Category' => 
    array (
      'class' => 'msCategory',
      'local' => 'category_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Filter' => 
    array (
      'class' => 'vfFilter',
      'local' => 'filter_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
