<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subrank Entity
 *
 * @property int $id
 * @property int $rank_id
 * @property int $numwithin
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $updated
 *
 * @property \App\Model\Entity\Rank $rank
 * @property \App\Model\Entity\Worksheet[] $worksheets
 */
class Subrank extends Entity
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
        'rank_id' => true,
        'numwithin' => true,
        'created' => true,
        'updated' => true,
        'rank' => true,
        'worksheets' => true,
    ];
}
