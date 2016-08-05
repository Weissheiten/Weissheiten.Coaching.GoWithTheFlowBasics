<?php
namespace Weissheiten\Coaching\GoWithTheFlowBasics\Command;

/*
 * This file is part of the Weissheiten.Flow.WiFiGuestCredentialsProvider package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\PersistenceManagerInterface;

use Weissheiten\Coaching\GoWithTheFlowBasics\Domain\Model\Voucher;
use Weissheiten\Coaching\GoWithTheFlowBasics\Domain\Model\Location;
use Weissheiten\Coaching\GoWithTheFlowBasics\Domain\Repository;

/**
 * @Flow\Scope("singleton")
 */
class WifiVoucherCommandController extends \TYPO3\Flow\Cli\CommandController
{

    /**
     * @Flow\Inject
     * @var Repository\VoucherRepository
     */
    protected $voucherRepository;

    /**
     * @Flow\Inject
     * @var Repository\LocationRepository
     */
    protected $locationRepository;

    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
     */
    protected $persistenceManager;


    /**
     * WiFi Code creation via command line
     *
     * Adds a new voucher to the database with the passed credentials.
     * Validity can be set in minutes as optional parameter
     *
     * @param string $username Username - This argument is required
     * @param string $password Password - This argument is required
     * @param string $validitymin Validity in minutes - this argument is optional, default is 60
     * @return void
     */
    public function insertVoucherCommand($username, $password, $validitymin = "60")
    {
        if ($username !== null && $password !== null && $validitymin !== null && is_numeric($validitymin)) {
            if (strlen($password) !== 7) {
                $this->outputLine('The string length of the password must be exactly 7.');
            } else {
                $voucher = new Voucher();
                $voucher->setUsername($username);
                $voucher->setPassword($password);
                $voucher->setValiditymin($validitymin);

                $this->voucherRepository->add($voucher);


                $this->outputLine(
                    'The voucher %s was added to the database, it is valid for %u minutes',
                    array($voucher->getUsername(), $voucher->getValiditymin())
                );
            }
        } else {
            $response = <<<OUT
              The voucher could not be added, your arguments passed were:
              Username: "%s", Password: "%s", Validity in minutes: "%s".
OUT;

            $this->outputLine($response, array($username, $password, $validitymin));
        }
    }

    /**
     * Location creation via the command line
     * Adds a new location to the database with the passed name and zipcode
     *
     *
     * @param string $name - this argument is required
     * @param int $zipcode - this argument is required
     * @return void
     */
    public function insertLocationCommand($name, $zipcode)
    {
        $location = new Location();
        $location->setName($name);
        $location->setZipcode($zipcode);

        $this->locationRepository->add($location);

        $this->outputLine('The Location %s with zipcode %s was added to the database.', array($name,$zipcode));
    }

    /**
     * Sets the first voucher found in the database as redeemed with the current timestamp
     * in the first location found
     *
     * @return void
     */
    public function markVoucherRedeemedCommand()
    {
        if ($this->locationRepository->countAll() > 0) {
            /* @var Location $location */
            $location = $this->locationRepository->findAll()->toArray()[0];

            if ($this->voucherRepository->countAll() > 0) {
                /* @var WiFiVoucher $voucher */
                $voucher = $this->voucherRepository->findAll()[0];
                $voucher->setRequesttime(new \DateTime());
                $voucher->setLocation($location);

                $this->voucherRepository->update($voucher);

                $this->outputLine(
                    "The voucher %s was redeemed for location %s with timestamp %s.",
                    array($voucher->getUsername(), $location->getName(), $voucher->getRequesttime()->format('d.M.Y h:s'))
                );

            } else {
                $this->outputLine('There is currently no voucher in the database, voucher not marked redeemed');
            }
        } else {
            $this->outputLine('There is currently no location in the database, voucher not marked redeemed');
        }
    }

    /**
     * List all locations currently in the database
     *
     * @return void
     */
    public function listLocationsCommand()
    {
        if ($this->locationRepository->countAll() > 0) {
            $this->outputLine("Location | Zip");

            /* @var Location $location */
            foreach ($this->locationRepository->findAll() as $location) {
                $this->outputLine(
                    '%s | %s',
                    array($location->getName(),
                        $location->getZipcode())
                );
            }
        } else {
            $this->outputLine("There are currently no locations in the database");
        }
    }

    /**
     * List all vouchers currently in the database
     *
     * @return void
     */
    public function listVouchersCommand()
    {
        if ($this->voucherRepository->countAll() > 0) {
            $this->outputLine("Voucher | Redeemed | Location");

            /* @var Voucher $voucher */
            foreach ($this->voucherRepository->findAll() as $voucher) {
                $redeemed = ($voucher->getRequesttime()!==null) ?
                    $voucher->getRequesttime()->format('d.M.Y h:s') : 'not redeemed';

                $outlet = ($voucher->getLocation()!==null) ?
                    $voucher->getLocation()->getName() : 'not redeemed';

                $this->outputLine(
                    '%s | %s | %s',
                    array($voucher->getUsername(),
                        $redeemed,
                        $outlet)
                );
            }
        } else {
            $this->outputLine("There are currently no vouchers in the database");
        }
    }

    /**
     * Clears all vouchers and locations
     */
    public function clearCommand()
    {
        $voucherCount = $this->voucherRepository->countAll();
        $locationCount = $this->locationRepository->countAll();

        $this->voucherRepository->removeAll();
        $this->locationRepository->removeAll();

        $this->outputLine(
            'Repositories cleared - %u Locations and %u Vouchers were removed',
            array($locationCount, $voucherCount)
        );
    }
}
