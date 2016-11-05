<?php
namespace MenuManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Link Entity.
 *
 * @property int $id
 * @property int $menu_id
 * @property \MenuManager\Model\Entity\Menu $menu
 * @property int $parent_id
 * @property \MenuManager\Model\Entity\Link $parent_link
 * @property string $name
 * @property string $url
 * @property string $attributes
 * @property bool $allow_html
 * @property bool $status
 * @property int $order
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \MenuManager\Model\Entity\Link[] $child_links
 */
class Link extends Entity
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
