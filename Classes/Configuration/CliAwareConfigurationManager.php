<?php

namespace Undkonsorten\ExtbaseCliAwareConfigurationManager\Configuration;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Extbase\Configuration\BackendConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\FrontendConfigurationManager;

class CliAwareConfigurationManager extends ConfigurationManager
{

    public function __construct(
        FrontendConfigurationManager $frontendConfigurationManager,
        BackendConfigurationManager $backendConfigurationManager,
        private readonly CommandLineInterfaceConfigurationManager $commandLineConfigurationManager,
    )
    {
        parent::__construct(
            $frontendConfigurationManager,
            $backendConfigurationManager
        );
    }

    public function getConfiguration(
        string $configurationType,
        ?string $extensionName = null,
        ?string $pluginName = null
    ): array {
        if (Environment::isCli()) {
            return match ($configurationType) {
                self::CONFIGURATION_TYPE_SETTINGS => $this->commandLineConfigurationManager->getConfiguration([], $extensionName, $pluginName)['settings'] ?? [],
                self::CONFIGURATION_TYPE_FRAMEWORK => $this->commandLineConfigurationManager->getConfiguration([], $extensionName, $pluginName),
                self::CONFIGURATION_TYPE_FULL_TYPOSCRIPT => $this->commandLineConfigurationManager->getTypoScriptSetup(),
                default => throw new \RuntimeException('Invalid configuration type "' . $configurationType . '"', 1721928055),
            };
        }
        return parent::getConfiguration($configurationType, $extensionName, $pluginName);
    }

}
