<?php

namespace Rewardful\RewardfulSpark;

use Laravel\Spark\User;
use Laravel\Spark\Spark;
use Laravel\Spark\Contracts\Repositories\UserRepository;
use Laravel\Spark\Contracts\Repositories\TeamRepository;
use Laravel\Spark\Contracts\Interactions\Settings\PaymentMethod\UpdatePaymentMethod as Contract;
use Laravel\Spark\Interactions\Settings\PaymentMethod\UpdateStripePaymentMethod as UpdatePaymentMethod;

class UpdateStripePaymentMethod extends UpdatePaymentMethod implements Contract
{
    /**
     * {@inheritdoc}
     */
    public function handle($billable, array $data)
    {
        // Next, we need to check if this application is storing billing addresses and if so
        // we will update the billing address in the database so that any tax information
        // on the user will be up to date via the taxPercentage method on the billable.
        if (Spark::collectsBillingAddress()) {
            Spark::call(
                $this->updateBillingAddressMethod($billable),
                [$billable, $data]
            );
        }

        if (! $billable->stripe_id) {
            $billable->createAsStripeCustomer([
                'metadata' =>[
                    'referral' => $data['referral'] ?? ''
                ]
            ]);
        }

        $billable->updateDefaultPaymentMethod($data['stripe_payment_method']);
    }
}
