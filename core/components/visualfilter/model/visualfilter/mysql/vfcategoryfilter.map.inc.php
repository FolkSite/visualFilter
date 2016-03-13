<?php
$xpdo_meta_map['vfCategoryFilter']= array (
  'package' => 'visualfilter',
  'version' => '1.1',
  'table' => 'vf_category_filters',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'priority' => 0,
    'category_id' => 0,
    'filter_id' => 0,
  ),
  'fieldMeta' => 
  array (
    'priority' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
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
