<?php

namespace Rewardful\RewardfulSpark;

use Illuminate\Support\Facades\Blade;
use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;
use Laravel\Spark\Contracts\Interactions\Subscribe as SubscribeContract;
use Laravel\Spark\Contracts\Interactions\SubscribeTeam as SubscribeTeamContract;
use Laravel\Spark\Contracts\Interactions\Settings\PaymentMethod\UpdatePaymentMethod;
class RewardfulServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Spark::swap(SubscribeContract::class.'@handle', Subscribe::class.'@handle');
        Spark::swap(SubscribeTeamContract::class.'@handle', SubscribeTeam::class.'@handle');
        Spark::swap(UpdatePaymentMethod::class.'@handle', UpdateStripePaymentMethod::class.'@handle');

        $this->publishes([
            __DIR__.'/config/rewardful.php' => config_path('rewardful.php'),
        ], 'rewardful-config');

        $this->publishes([
            __DIR__.'/resources/js' => resource_path('js/rewardful'),
        ], 'rewardful-vue');

        Blade::directive('rewardful_js', function () {
            return "<script async src='https://r.wdfl.co/rw.js' data-rewardful='".config("rewardful.api_key")."'></script>";
        });
    }
}
