<?php
namespace todolist\system\event\listener;

use wcf\system\event\listener\IParameterizedEventListener;
use wcf\system\WCF;
use todolist\page\TodoPage;
use wcf\system\reaction\ReactionHandler;

/**
 * Event listener to implement reactions to TodoPage
 * 
 * @author  Julian Pfeil <https://julian-pfeil.de>
 * @copyright   2022 Julian Pfeil Websites & Co.
 * @license Creative Commons <by> <https://creativecommons.org/licenses/by/4.0/legalcode>
 */

class TodoReactionsEventListener implements IParameterizedEventListener {
    
    /**
     * contains todos reaction data
     */
	protected $todoLikeData = [];

    /**
     * @inheritDoc
     */
    public function execute($eventObj, $className, $eventName, array &$parameters) {
        $this->$eventName($eventObj);
    }

   /**
     * @inheritDoc
     */
    protected function assignVariables()
    {
        WCF::getTPL()->assign([
            'todoLikeData' => $this->todoLikeData
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function readData(TodoPage $eventObj)
    {
		if (MODULE_LIKE) {
			$objectType = ReactionHandler::getInstance()->getObjectType('de.julian-pfeil.todolist.reactions.likeableTodo');
			ReactionHandler::getInstance()->loadLikeObjects($objectType, [$eventObj->todoID]);
			$this->todoLikeData = ReactionHandler::getInstance()->getLikeObjects($objectType);
		}
    }
}
