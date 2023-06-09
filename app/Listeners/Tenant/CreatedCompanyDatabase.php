<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\CompanyCreated;
use App\Events\Tenant\DatabaseCreated;
use App\Tenant\Database\DatabaseManager;
use Exception;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreatedCompanyDatabase
{

    private $databaseManager;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DatabaseManager $databaseManager)
    {

        $this->databaseManager = $databaseManager;

    }

    /**
     * Handle the event.
     *
     * @param  CompanyCreated  $event
     * @return void
     */
    public function handle(CompanyCreated $event)
    {
       $company =  $event->company();
       if( !$this->databaseManager->createdDatabase($company)){
                throw new Exception('Error creating database company');
       }


       //run migrations

       event(new DatabaseCreated($company));
    }
}
