<?php
namespace Weissheiten\Coaching\GoWithTheFlowBasics\Command;

/*
 * This file is part of the Weissheiten.Coaching.GoWithTheFlowBasics package.
 */

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class WifiVoucherCommandController extends \TYPO3\Flow\Cli\CommandController{

    /**
     * WiFi Code creation via command line
     *
     * Adds a new voucher to the database with the passed credentials
     *
     * @param string $username - This argument is required
     * @param string $password - This argument is required
     * @return void
     */
    public function insertCommand($username, $password){
        $this->outputLine("Username: $username, Password: $password");
    }
}