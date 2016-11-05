<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * QuestionsTag Entity
 *
 * @property int $question_id
 * @property int $tag_id
 * @property int $id
 *
 * @property \App\Model\Entity\Tag $tag
 * @property \App\Model\Entity\Question $question
 */
class QuestionsTag extends Entity
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
}
