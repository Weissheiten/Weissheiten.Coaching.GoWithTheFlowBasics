<?php
namespace Weissheiten\Coaching\GoWithTheFlowBasics\Controller;

/*
 * This file is part of the Weissheiten.Coaching.GoWithTheFlowBasics package.
 */

use TYPO3\Flow\Annotations as Flow;

class StandardController extends \TYPO3\Flow\Mvc\Controller\ActionController
{

    /**
     * @return void
     */
    public function indexAction()
    {
        \TYPO3\Flow\var_dump('demo');

        $this->view->assign('foos', array(
            'bar', 'baz'
        ));
    }

}
