<?php
namespace Weissheiten\Coaching\GoWithTheFlowBasics\Controller;

/*
 * This file is part of the Weissheiten.Coaching.GoWithTheFlowBasics package.
 */

use TYPO3\Flow\Annotations as Flow;
use Weissheiten\Coaching\GoWithTheFlowBasics\Domain\Repository\VoucherRepository;
use Weissheiten\Coaching\GoWithTheFlowBasics\Domain\Model\Voucher;


class StandardController extends \TYPO3\Flow\Mvc\Controller\ActionController
{
    /**
     * @var array
     */
    protected $viewFormatToObjectNameMap = array(
        'html' => 'TYPO3\Fluid\View\TemplateView',
        'json' => 'TYPO3\Flow\Mvc\View\JsonView'
    );

    /**
     * A list of IANA media types which are supported by this controller
     *
     * @var array
     */
    protected $supportedMediaTypes = array('application/json', 'text/html');

    /**
     * @Flow\Inject
     * @var VoucherRepository
     */
    protected $voucherRepository;

    /**
     * @return void
     */
    public function indexAction()
    {
        if ($this->voucherRepository->countAll() > 0) {
            /* @var Voucher $voucher */
            $voucher = $this->voucherRepository->findAll()[0];

            $this->view->assign('value', array(
                'username' => $voucher->getUsername(),
                'password' => $voucher->getPassword()
            ));
        }
    }
}
