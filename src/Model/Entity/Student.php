<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property int $id
 * @property string|null $student_number
 * @property string $name
 * @property int|null $rank_id
 * @property int|null $worksheets_count
 * @property int|null $perfects_count
 * @property int|null $accuracy_rate
 * @property \Cake\I18n\FrozenDate|null $created
 * @property \Cake\I18n\FrozenDate|null $modified
 * @property string|null $email
 * @property string $password
 * @property int $grade_id
 *
 * @property \App\Model\Entity\Rank $rank
 * @property \App\Model\Entity\Grade $grade
 * @property \App\Model\Entity\Result[] $results
 */
class Student extends Entity
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
        'student_number' => true,
        'name' => true,
        'rank_id' => true,
        'worksheets_count' => true,
        'perfects_count' => true,
        'accuracy_rate' => true,
        'created' => true,
        'modified' => true,
        'email' => true,
        'password' => true,
        'grade_id' => true,
        'rank' => true,
        'grade' => true,
        'results' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];
}
