# Introduction

RewardfulSpark is a small library that allows you to integrate your Laravel Spark application with Rewardful with minimal configuration.

# Installation

First, require the RewardfulSpark package with Composer

For Spark v9.0+:

`composer require rewardful/rewardful-spark "3.*"`

For Spark v6 - 8, please use branch [v2.0](https://github.com/rewardful/rewardful-spark/tree/2.0).

For Spark v5, please use branch [v1.0](https://github.com/rewardful/rewardful-spark/tree/1.0).

## Publish the package

You can publish the configuration separately by running this command.

`php artisan vendor:publish --tag=rewardful-config --force`

You can also publish the Vue components using this command

`php artisan vendor:publish --tag=rewardful-vue --force`

# Configuration
Before using RewardfulSpark you will need to configure your API key. Add the following line to your `.env` file.

`REWARDFUL_API_KEY=<API_KEY>`

# Frontend
In order for Rewardful to capture your referrals information, you need to tinker your `views` and `vue` files slightly.

## Blade Layout
In your blade layout, you need to include this blade directive so it's reflected in all your pages. This will ensure our Javascript library is monitoring all your incoming referrals. For example in the bottom of your `app.blade.php` add the following line before the closing `</body>` tag.

`@rewardful_js`

## Vue components
RewardfulSpark ships with a small Vue components that gets mixed with the `register-stripe` and `subscribe-stripe` components. Depending on your configuration you will need to update those files.
### Laravel Spark 7.0+

#### Credit Card Upfront

If you requiring the user to enter their credit card details *Upfront* (i.e. during registration)


Include the vue module into your `resources/js/spark-components/auth/register-stripe.js`. Assuming stock file with no changes, this is how your file should look like.

```
var base = require('auth/register-stripe');
// include the module
var rewardful = require('../../rewardful/rewardful-register');

Vue.component('spark-register-stripe', {
	// add the module as mixing along with the base component
    mixins: [base, rewardful]
});

```

#### No Credit Card Upfront

If you do not require the user to enter their credit card upfront, and provide `GenericTrial`, then you need to ensure the `referral` code is captured during the subscription.

Include the vue module into your `resources/js/spark-components/settings/subscription/subscribe-stripe.js`. Assuming stock file with no changes, this is how your file should look like.

```
var base = require('settings/subscription/subscribe-stripe');
// include the module
var rewardful = require('../../../rewardful/rewardful-register');

Vue.component('spark-subscribe-stripe', {
	// add the module as mixing along with the base component
    mixins: [base, rewardful]
});
```

### Laravel Spark 5 & 6

#### Credit Card Upfront

If you requiring the user to enter their credit card details *Upfront* (i.e. during registration)


Include the vue module into your `resources/assets/js/spark-components/auth/register-stripe.js`. Assuming stock file with no changes, this is how your file should look like.

```
var base = require('auth/register-stripe');
// include the module
var rewardful = require('../../../../js/rewardful/rewardful-register');

Vue.component('spark-register-stripe', {
	// add the module as mixing along with the base component
    mixins: [base, rewardful]
});

```

#### No Credit Card Upfront

If you do not require the user to enter their credit card upfront, and provide `GenericTrial`, then you need to ensure the `referral` code is captured during the subscription.

Include the vue module into your `resources/assets/js/spark-components/settings/subscription/subscribe-stripe.js`. Assuming stock file with no changes, this is how your file should look like.

```
var base = require('settings/subscription/subscribe-stripe');
// include the module
var rewardful = require('../../../../../js/rewardful/rewardful-register');

Vue.component('spark-subscribe-stripe', {
	// add the module as mixing along with the base component
    mixins: [base, rewardful]
});
```

## Compile your assets
For the changes to take effect you need to compile your assets. Run the command relevant to your environment. Assuming production build:

`npm run production`

# Changelog

Please see CHANGELOG for more information what has changed recently.

# Credits

Mina Abadir

# License

The MIT License (MIT). Please see License File for more information.
