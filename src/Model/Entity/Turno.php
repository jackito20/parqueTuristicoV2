<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Turno Entity
 *
 * @property int $id
 * @property int $id_empleado
 * @property int $id_horario
 */
class Turno extends Entity
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
        'id_empleado' => true,
        'id_horario' => true
    ];
}
