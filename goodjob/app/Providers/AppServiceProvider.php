<?php

namespace App\Providers;

use App\Repository\ClientRepository;
use App\Repository\Interfaces\InterfaceClientRepository;
use App\Repository\Interfaces\InterfaceJobListRepository;
use App\Repository\Interfaces\InterfacePackageRepository;
use App\Repository\Interfaces\InterfacePlaceRepository;
use App\Repository\Interfaces\InterfaceSchedulerRepository;
use App\Repository\Interfaces\InterfaceSkillRepository;
use App\Repository\Interfaces\InterfaceStaffMemberRepository;
use App\Repository\Interfaces\InterfaceTeamRepository;
use App\Repository\JobListRepository;
use App\Repository\PackageRepository;
use App\Repository\PlaceRepository;
use App\Repository\SchedulerRepository;
use App\Repository\SkillRepository;
use App\Repository\StaffMemberRepository;
use App\Repository\TeamRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(InterfaceTeamRepository::class, TeamRepository::class);
        $this->app->bind(InterfacePackageRepository::class, PackageRepository::class);
        $this->app->bind(InterfaceClientRepository::class, ClientRepository::class);
        $this->app->bind(InterfaceJobListRepository::class, JobListRepository::class);
        $this->app->bind(InterfacePlaceRepository::class, PlaceRepository::class);
        $this->app->bind(InterfaceStaffMemberRepository::class, StaffMemberRepository::class);
        $this->app->bind(InterfaceContactPersonRepository::class, ContactPersonRepository::class);
        $this->app->bind(InterfaceSchedulerRepository::class, SchedulerRepository::class);
        $this->app->bind(InterfaceSkillRepository::class, SkillRepository::class);
        
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
