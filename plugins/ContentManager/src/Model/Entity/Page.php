<?php
namespace ContentManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Page Entity.
 *
 * @property int $id
 * @property int $page_type_id
 * @property \ContentManager\Model\Entity\PageType $page_type
 * @property int $role_id
 * @property \ContentManager\Model\Entity\Role $role
 * @property string $name
 * @property string $layout
 * @property string $meta_title
 * @property string $meta_description
 * @property string $file_name
 * @property bool $status
 * @property string $url
 */
class Page extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
