<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Result Entity
 *
 * @property int $student_id
 * @property int $worksheet_id
 * @property string|null $result
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $updated
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Worksheet $worksheet
 */
class Result extends Entity
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
        'result' => true,
        'created' => true,
        'updated' => true,
        'student' => true,
        'worksheet' => true,
    ];
}
