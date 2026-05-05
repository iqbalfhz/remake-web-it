<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Mews\Purifier\Facades\Purifier;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Super admin (is_admin flag) bypasses all Gate checks
        Gate::before(function ($user, $ability) {
            if ($user->is_admin) {
                return true;
            }
        });

        // Add HTML5 elements support for HTMLPurifier (used by Quill editor)
        Purifier::config('quill', function ($config) {
            $def = $config->maybeGetRawHTMLDefinition();
            if ($def) {
                $def->addElement('figure', 'Block', 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow', 'Common');
                $def->addElement('figcaption', 'Inline', 'Flow', 'Common');
            }
        });
    }
}
