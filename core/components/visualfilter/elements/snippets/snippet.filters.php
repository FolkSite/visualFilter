<?php
/** @var array $scriptProperties */
/** @var visualFilter $visualFilter */
if (!$visualFilter = $modx->getService('visualFilter', 'visualFilter', $modx->getOption('visualfilter_core_path', null, $modx->getOption('core_path') . 'components/visualfilter/') . 'model/visualfilter/', $scriptProperties)) {
	return 'Could not load visualFilter class!';
}

// Do your snippet code here. This demo grabs 5 items from our custom table.
$tvName = $modx->getOption('tvName', $scriptProperties, 'visualFilter');
$mode = $modx->getOption('mode', $scriptProperties, 'filters');
$sortby = $modx->getOption('sortby', $scriptProperties, 'priority');
$sortdir = $modx->getOption('sortbir', $scriptProperties, 'ASC');
$outputSeparator = $modx->getOption('outputSeparator', $scriptProperties, ',');
$toPlaceholder = $modx->getOption('toPlaceholder', $scriptProperties, false);

$categoryFilters = $modx->resource->getTVValue($tvName);

if(empty($categoryFilters)) {
    // Get parent IDs
    $parents = array();
    foreach ($modx->getParentIds($modx->resource->get('id'), 10, array('context' => $modx->resource->get('context'))) as $parentId) {
        if ($parentId) {
            array_push($parents, $parentId);
        }
    }

    foreach ($parents as $parentId) {
        $parent = $modx->getObject('modResource', $parentId);
        if ($categoryFilters = $parent->getTVValue($tvName)) {
            if(!empty($categoryFilters)) {
                break;
            }
        }
    }
}

// Build query
$q = $modx->newQuery('vfFilter');
if(!empty($categoryFilters)) {
    $q->where(array('`vfFilter`.`id`:IN' => explode(",", $categoryFilters)));
    $q->sortby('FIELD(`vfFilter`.`id`, '.$categoryFilters.' )');
}
else {
    $q->sortby($sortby, $sortdir);
}
$filters = $modx->getIterator('vfFilter', $q);

// Iterate through items
$list = array();
/** @var vfFilter $filter */
foreach ($filters as $filter) {
    $f = '';
    if($mode == 'filters') {
        $f = $filter->get('code').'|'.$filter->get('field').':'.$filter->get('filter_method');
    }
    elseif($mode == 'aliases') {
        $alias = $filter->get('alias');
        if(!empty($alias)) {
            $f = $filter->get('code').'|'.$filter->get('field').'=='.$alias;
        }

    }
    if(!empty($f)){
	    $list[] = $f;
    }
}

// Output
$output = implode($outputSeparator, $list);
if (!empty($toPlaceholder)) {
	$modx->setPlaceholder($toPlaceholder, $output);
	return '';
}
return $output;
