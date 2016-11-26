<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\Log\Log;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;

/**
 * Loggable behavior
 */
class LoggableBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        Log::debug('Save something.');
    }
}
