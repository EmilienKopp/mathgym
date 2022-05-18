<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rank Entity
 *
 * @property int $id
 * @property string $name
 * @property int $base
 * @property int $max
 *
 * @property \App\Model\Entity\Student[] $students
 * @property \App\Model\Entity\Subrank[] $subranks
 */
class Rank extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'name' => true,
        'base' => true,
        'students' => true,
        'subranks' => true,
        'max' => true
    ];
}
