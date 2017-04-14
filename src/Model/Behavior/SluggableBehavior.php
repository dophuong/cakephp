<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;

class SluggableBehavior extends Behavior
{
    public function slug($value)
    {
        return Inflector::slug($value, $this->_config['replacement']);
    }
}

?>