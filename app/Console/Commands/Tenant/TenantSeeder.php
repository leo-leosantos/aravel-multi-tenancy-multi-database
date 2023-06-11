<?php

namespace App\Console\Commands\Tenant;

use App\Models\Company;
use App\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantSeeder extends Command
{
    private $tenant;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:seed {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rum Seeder Tenants';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ManagerTenant $tenant)
    {
        parent::__construct();


        $this->tenant = $tenant;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        if ($id = $this->argument('id')){
            $company  = Company::find($id);
            if($company){
                return  $this->execCommand($company);
            }



        }

        $companies = Company::all();

        foreach ($companies as $company) {


            $this->execCommand($company);

        }

    }

    public function execCommand(Company $company)
    {

        $this->tenant->setConnection($company);

        $this->info("Rum Migrations Completed {$company->name}");

       $command = Artisan::call('db:seed',[
            '--class'=>'TenantsTableSeeder',
        ]);

        if($command === 0){
            $this->info("Success {$company->name}");

        }

        $this->info("End connecting Migrations Completed {$company->name}");
        $this->info('----------------------------------------------------------------');
    }
}
