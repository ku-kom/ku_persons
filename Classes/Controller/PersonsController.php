<?php

declare(strict_types=1);

namespace UniversityOfCopenhagen\KuPersons\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class PersonsController extends ActionController
{
    /**
     * Initiate the RequestFactory.
     */
    public function __construct(
        protected readonly RequestFactory $requestFactory,
    ) {
    }

    /**
     * Return data to fluid template.
     * @return ResponseInterface
     */
    public function personsSearchAction(): ResponseInterface
    {
        $cObjectData = $this->configurationManager->getContentObject()->data;
        $this->view->assign('data', $cObjectData);

        return $this->htmlResponse();
    }
}
