# Magento 2 Klar Integration Module

## Overview

The Magento 2 Klar integration module is a powerful tool designed to streamline the process of integrating the Klar
business intelligence platform into your Magento 2 store. With this module, you can easily connect your store to Klar
and centralize your data from a variety of sources, including your eCommerce platform, payment providers, and
advertising channels. Once your data is centralized, you can use Klar's powerful reporting and analytics tools to gain
deep insights into your store's performance, from customer behavior and sales trends to advertising ROI and much more.

## Installation

To install the module, follow these steps:

1. Add the GitHub repository as a new repository in your Magento 2 project's `composer.json` file:

    ```
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ltd-iconcept/magento2-klar"
        }
    ]
    ```

2. Add the module to your project's `composer.json` file using the `require` command:

    ```
    composer require ltd-iconcept/magento2-klar:^1.0.0
    ```

   The `^1.0.0` indicates that you want to install version 1.0.0 or later.

3. Run the Composer install command:

    ```
    composer install
    ```

4. Enable the module by running the Magento CLI command:

    ```
    bin/magento module:enable ICT_Klar
    ```

5. Run the setup upgrade command to install the module and its dependencies:

    ```
    bin/magento setup:upgrade
    ```

6. Clear the Magento cache:

    ```
    bin/magento cache:clean
    ```

7. Configure the module as needed.

## Configuration

To enable Magento 2 Klar integration in the Magento admin panel, follow these steps:

1. Log in to the Magento admin panel.
2. Navigate to Stores > Configuration > Sales > Klar.
3. Set the "Enabled" flag to "Yes".
4. Fill in the "API URL", "API Version", and "API Token" fields with the appropriate values. These values will be
   provided to you by Klar.
5. Save the configuration and clear Magento cache.

## Usage

Once the module is installed and configured, you can use it to centralize your store's data and gain insights into its
performance using Klar's powerful reporting and analytics tools. There are no extra actions needed, integration is
working automatically.

## Support

If you encounter any issues with the Magento 2 Klar integration module, please report them in the GitHub repository or
contact the module developer for support.

## License

The Magento 2 Klar integration module is licensed under the GNU General Public License v3.0.