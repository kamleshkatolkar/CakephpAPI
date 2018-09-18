<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property int $dept_id
 * @property int $ext_id
 * @property \Cake\I18n\FrozenDate $DOB
 * @property \Cake\I18n\FrozenDate $DOJ
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property int $mobile_no
 * @property string $gender
 * @property int $zipcode
 * @property string $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Dept $dept
 * @property \App\Model\Entity\Ext $ext
 */
class Employee extends Entity
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
        'dept_id' => true,
        'ext_id' => true,
        'DOB' => true,
        'DOJ' => true,
        'first_name' => true,
        'last_name' => true,
        'address' => true,
        'mobile_no' => true,
        'gender' => true,
        'zipcode' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'dept' => true,
        'ext' => true
    ];
}
