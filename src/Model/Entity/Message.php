<?php
namespace App\Model\Entity;

use Cake\Chronos\Chronos;
use Cake\ORM\Entity;

/**
 * Message Entity
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property int $voice_id
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $end_date
 * @property bool $monday
 * @property bool $tuesday
 * @property bool $wednesday
 * @property bool $thursday
 * @property bool $friday
 * @property bool $saturday
 * @property bool $sunday
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $ends
 * @property bool $active
 * @property int $times_planned
 *
 * @property \App\Model\Entity\Voice $voice
 */
class Message extends Entity
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
        'id' => false
    ];

    protected function _getStatus()
    {
        if (Chronos::today()->gt($this->_properties['end_date'])) {
            return 'verlopen';
        }

        if ($this->_properties['active'] && Chronos::today()->gte($this->_properties['start_date'])) {
            return 'actief';
        }

        return 'inactief';
    }
}
