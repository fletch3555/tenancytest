<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\InputInterface;
use Tenancy\Identification\Concerns\AllowsTenantIdentification;
use Tenancy\Identification\Contracts\Tenant AS Contract;
use Tenancy\Identification\Drivers\Console\Contracts\IdentifiesByConsole;
use Tenancy\Identification\Drivers\Http\Contracts\IdentifiesByHttp;

class Tenant extends Model implements Contract, IdentifiesByHttp, IdentifiesByConsole
{
    use AllowsTenantIdentification;

    public function hostnames() {
        return $this->hasMany(Hostname::class);
    }

    public function tenantIdentificationByConsole(InputInterface $input): ?Contract
    {
        if (app()->runningInConsole() && $input->hasParameterOption('--tenant')) {
            return $this->query()
                ->whereKey($input->getParameterOption('--tenantId'))
                ->first();
        }

        return null;
    }

    public function tenantIdentificationByHttp(Request $request): ?Contract
    {
        $host = $request->getHttpHost();

        return Hostname::query()->where('fqdn', $host)->firstOrFail()->tenant;
    }
}
