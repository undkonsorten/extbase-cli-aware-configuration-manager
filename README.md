Extbase cli aware configuration manager
===============

This extension provides a configuration manager for cli context in TYPO3.

So if you need for example typoscript settings in cli context e.g. commands this extension helps to do so.

The extension needs to be configured in the Service.yaml or Service.php:

```
TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface:
    alias: 'Undkonsorten\ExtbaseCliAwareConfigurationManager\Configuration\CliAwareConfigurationManager'
    public: true

  Undkonsorten\ExtbaseCliAwareConfigurationManager\Configuration\CommandLineInterfaceConfigurationManager:
    arguments:
      $siteIdentifier: 'SomeSiteIdentifier'
```

The extension will look for typoscript setting on the site with identifier 'SomeSiteIdentifier'.

This extension also solves the problem using extbase repositories within cli context e.g. this error:

```
[ RuntimeException ]
No request given. ConfigurationManager has not been initialized properly.

```

For more information about this problem/topic:
https://forge.typo3.org/issues/105554
https://forge.typo3.org/issues/105616
