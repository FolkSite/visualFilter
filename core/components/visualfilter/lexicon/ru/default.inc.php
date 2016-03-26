<?php
include_once 'setting.inc.php';

$_lang['superFilter'] = 'Фильтры';
$_lang['superFilter_menu'] = 'Фильтры';
$_lang['superFilter_menu_desc'] = 'Управление фильтрами';

$_lang['visualfilter'] = 'Настройка Фильтров';
$_lang['visualFilter'] = 'Настройка Фильтров';
$_lang['vf_menu_desc'] = 'Создание фильтров, их настройка';
$_lang['visualFilterTab'] = 'Фильтры';
$_lang['vf_intro_msg'] = 'Вы можете выделять сразу несколько записей при помощи Shift или Ctrl.';

$_lang['vf_filters'] = 'Фильтры';
$_lang['vf_filter_id'] = 'Id';
$_lang['vf_filter_priority'] = 'Приоритет';
$_lang['vf_filter_code'] = 'Код таблицы';
$_lang['vf_filter_field'] = 'Поле';
$_lang['vf_filter_filter_method'] = 'Метод фильтрации';
$_lang['vf_filter_alias'] = 'Псевдоним фильтра';
$_lang['vf_filter_title'] = 'Заголовок';
$_lang['vf_filter_description'] = 'Описание';
$_lang['vf_filter_active'] = 'Активен';
$_lang['vf_filter_collapse'] = 'Свернут';

$_lang['vf_filter_tab_general'] = 'Общее';
$_lang['vf_filter_tab_info'] = 'Описание';
$_lang['vf_filter_create'] = 'Создать фильтр';
$_lang['vf_filter_update'] = 'Изменить фильтр';

$_lang['vf_code_resource'] = 'resource / Поле страницы';
$_lang['vf_code_tv'] = 'tv / TV параметр';
$_lang['vf_code_ms'] = 'ms / Поле товара';
$_lang['vf_code_msoption'] = 'msoption / Опция товара';

$_lang['vf_filter_method_default'] = 'default / По-умолчанию';
$_lang['vf_filter_method_number'] = 'number / От-До';
$_lang['vf_filter_method_boolean'] = 'boolean / Да/Нет';
$_lang['vf_filter_method_parents'] = 'parents / Родители';
$_lang['vf_filter_method_categories'] = 'categories / Родитель';
$_lang['vf_filter_method_grandparents'] = 'grandparents / Категории-дедушки';
$_lang['vf_filter_method_vendors'] = 'vendors / Производители';
$_lang['vf_filter_method_fullname'] = 'fullname / Имя пользователя';
$_lang['vf_filter_method_year'] = 'year / Год';
$_lang['vf_filter_method_month'] = 'month / Месяц';
$_lang['vf_filter_method_day'] = 'day / День';

$_lang['vf_item_create'] = 'Создать';
$_lang['vf_item_add'] = 'Добавить';
$_lang['vf_item_update'] = 'Изменить';
$_lang['vf_item_enable'] = 'Включить';
$_lang['vf_items_enable'] = 'Включить';
$_lang['vf_item_disable'] = 'Отключить';
$_lang['vf_items_disable'] = 'Отключить';
$_lang['vf_item_remove'] = 'Удалить';
$_lang['vf_items_remove'] = 'Удалить';
$_lang['vf_item_remove_confirm'] = 'Вы уверены, что хотите удалить эту записть?';
$_lang['vf_items_remove_confirm'] = 'Вы уверены, что хотите удалить эти записи?';
$_lang['vf_item_active'] = 'Включено';
$_lang['vf_default'] = 'По-умолчанию';

$_lang['vf_category_filters_action_add'] = 'Добавить';
$_lang['vf_category_filters_action_clone'] = 'Скопировать из верхней категории';
$_lang['vf_category_filters_action_fill'] = 'Добавить все доступные';

$_lang['vf_category_filters_clone'] = 'Скопировать фильтры от родительской категории';
$_lang['vf_category_filters_clone_confirm'] = 'Скопировать фильтры (если существуют) от родительской категории (рекурсивно) к этой категории? Все существующие записи будут заменены!';
$_lang['vf_category_filters_fill'] = 'Добавить все доступные в системе фильтры';
$_lang['vf_category_filters_fill_confirm'] = 'Добавить все доступные в системе фильтры к этой категории? Все существующие записи будут заменены!';
$_lang['vf_category_filters_clone_no_parent'] = 'Нет родительской категории с установленными фильтрами';



$_lang['vf_filter_err_code'] = 'Вы должны указать код таблицы.';
$_lang['vf_filter_err_field'] = 'Вы должны указать поле фильтрации.';
$_lang['vf_filter_err_method'] = 'Вы должны указать метод фильтрации.';
$_lang['vf_item_err_ae'] = 'Такая запись уже существует.';
$_lang['vf_item_err_nf'] = 'Запись не найдена.';
$_lang['vf_item_err_ns'] = 'Запись не указана.';
$_lang['vf_item_err_remove'] = 'Ошибка при удалении записи.';
$_lang['vf_item_err_save'] = 'Ошибка при сохранении записи.';

$_lang['vf_grid_search'] = 'Поиск';
$_lang['vf_grid_actions'] = 'Действия';

$_lang['vf_page_intro_msg'] = 'Пустая таблица означает, что используется фильтр "по-умолчанию" или фильтр родительской категории (если задан). <br /> Будьте внимательны, изменения на этой вкладке сохраняются сразу.';
$_lang['vf_category_filter_priority'] = 'Приоритет';
$_lang['vf_category_filter_title'] = 'Фильтр';
$_lang['vf_category_filter_value'] = 'Значение фильтра';
$_lang['vf_category_filter_active'] = 'Активен';
$_lang['vf_category_filter_collapse'] = 'Свернут';
$_lang['vf_category_filter_filter_id'] = 'Выберите Фильтр:';
