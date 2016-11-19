<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

/**
 * Table Model
 */
class Table extends \Cake\ORM\Table
{
    public function findLatest(Query $q, array $options)
    {
        return $q
            ->order([$this->aliasField('created') => 'desc']);
    }
}