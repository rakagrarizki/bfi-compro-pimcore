<?php 

/** 
* Generated at: 2019-10-28T12:09:20+01:00
* Inheritance: no
* Variants: no
* Changed by: admin (2)
* IP: ::1


Fields Summary: 
- localizedfields [localizedfields]
-- Nama [input]
*/ 


return Pimcore\Model\DataObject\ClassDefinition::__set_state(array(
   'id' => '14',
   'name' => 'ManajemenLevel',
   'description' => '',
   'creationDate' => 0,
   'modificationDate' => 1572260959,
   'userOwner' => 2,
   'userModification' => 2,
   'parentClass' => '',
   'listingParentClass' => '',
   'useTraits' => '',
   'listingUseTraits' => '',
   'allowInherit' => false,
   'allowVariants' => NULL,
   'showVariants' => false,
   'layoutDefinitions' => 
  Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
     'fieldtype' => 'panel',
     'labelWidth' => 100,
     'layout' => NULL,
     'name' => 'pimcore_root',
     'type' => NULL,
     'region' => NULL,
     'title' => NULL,
     'width' => NULL,
     'height' => NULL,
     'collapsible' => false,
     'collapsed' => false,
     'bodyStyle' => NULL,
     'datatype' => 'layout',
     'permissions' => NULL,
     'childs' => 
    array (
      0 => 
      Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
         'fieldtype' => 'panel',
         'labelWidth' => 100,
         'layout' => NULL,
         'name' => 'Layout',
         'type' => NULL,
         'region' => NULL,
         'title' => '',
         'width' => NULL,
         'height' => NULL,
         'collapsible' => false,
         'collapsed' => false,
         'bodyStyle' => '',
         'datatype' => 'layout',
         'permissions' => NULL,
         'childs' => 
        array (
          0 => 
          Pimcore\Model\DataObject\ClassDefinition\Data\Localizedfields::__set_state(array(
             'fieldtype' => 'localizedfields',
             'phpdocType' => '\\Pimcore\\Model\\DataObject\\Localizedfield',
             'childs' => 
            array (
              0 => 
              Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
                 'fieldtype' => 'input',
                 'width' => NULL,
                 'queryColumnType' => 'varchar',
                 'columnType' => 'varchar',
                 'columnLength' => 190,
                 'phpdocType' => 'string',
                 'regex' => '',
                 'unique' => false,
                 'name' => 'Nama',
                 'title' => 'Nama',
                 'tooltip' => '',
                 'mandatory' => true,
                 'noteditable' => false,
                 'index' => false,
                 'locked' => NULL,
                 'style' => '',
                 'permissions' => NULL,
                 'datatype' => 'data',
                 'relationType' => false,
                 'invisible' => false,
                 'visibleGridView' => false,
                 'visibleSearch' => false,
              )),
            ),
             'name' => 'localizedfields',
             'region' => NULL,
             'layout' => NULL,
             'title' => '',
             'width' => '',
             'height' => '',
             'maxTabs' => NULL,
             'labelWidth' => NULL,
             'hideLabelsWhenTabsReached' => NULL,
             'referencedFields' => 
            array (
            ),
             'tooltip' => NULL,
             'mandatory' => NULL,
             'noteditable' => NULL,
             'index' => NULL,
             'locked' => NULL,
             'style' => NULL,
             'permissions' => NULL,
             'datatype' => 'data',
             'columnType' => NULL,
             'queryColumnType' => NULL,
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => true,
             'visibleSearch' => true,
          )),
        ),
         'locked' => false,
      )),
    ),
     'locked' => false,
  )),
   'icon' => '',
   'previewUrl' => '',
   'group' => '',
   'showAppLoggerTab' => false,
   'linkGeneratorReference' => '',
   'propertyVisibility' => 
  array (
    'grid' => 
    array (
      'id' => true,
      'key' => false,
      'path' => true,
      'published' => true,
      'modificationDate' => true,
      'creationDate' => true,
    ),
    'search' => 
    array (
      'id' => true,
      'key' => false,
      'path' => true,
      'published' => true,
      'modificationDate' => true,
      'creationDate' => true,
    ),
  ),
   'dao' => NULL,
));
