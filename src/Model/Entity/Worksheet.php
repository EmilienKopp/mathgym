<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Worksheet Entity
 *
 * @property int $id
 * @property int $subrank_id
 * @property string|null $link
 * @property \Cake\I18n\FrozenDate $created
 * @property \Cake\I18n\FrozenDate $modified
 *
 * @property \App\Model\Entity\Subrank $subrank
 * @property \App\Model\Entity\Result[] $results
 */
class Worksheet extends Entity
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
        'subrank_id' => true,
        'link' => true,
        'created' => true,
        'modified' => true,
        'subrank' => true,
        'results' => true,
    ];
}
