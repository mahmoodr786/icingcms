<?php
namespace MenuManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Menu Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $key
 * @property string $tag
 * @property string $tag_attributes
 * @property string $list_tag
 * @property string $list_tag_attributes
 * @property string $dropdown_tag
 * @property string $dropdown_tag_attributes
 * @property string $dropdown_list_tag
 * @property string $dropdown_list_tag_attributes
 * @property string $active_class
 * @property bool $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \MenuManager\Model\Entity\Link[] $links
 */
class Menu extends Entity
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
