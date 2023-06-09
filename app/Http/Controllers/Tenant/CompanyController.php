<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Tenant\CompanyCreated;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{

    private $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function store(Request $request)
    {


        $company = $this->company->create([
            'name' => 'Empresa X' . str_random(5),
            'domain' => str_random(5). 'minhaempresa.com',
            'bd_database' => 'multi_tenant'. str_random(5),
            'bd_hostname' => 'mysql',
            'bd_username' => 'root',
            'bd_password' => 'root'
        ]);


      $event =   event(new CompanyCreated($company));



    }
}
