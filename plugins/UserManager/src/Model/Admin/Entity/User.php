<?php
namespace UserManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity.
 *
 * @property int $id
 * @property int $role_id
 * @property \UserManager\Model\Entity\Role $role
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $activation_key
 * @property bool $status
 * @property \Cake\I18n\Time $created
 * @property string $modified
 */
class User extends Entity
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
