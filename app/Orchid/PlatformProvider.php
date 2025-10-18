<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('About BOA')
               
                ->icon('bs.book')
                ->title('Navigation')
               
                  ->divider()
                ,

            Menu::make('History')
                ->icon('bs.collection')
                ->route('about.boa.history'),

               Menu::make('Mission & Vision')
                ->icon('bs.collection')
                ->route('about.boa.mission')
                  ->divider()
                ,

            Menu::make('Statute')
                ->icon('bs.card-list')
                 ->route('statute.index')
                 ->divider(),
               

            Menu::make('Activities')
                ->icon('bs.window-sidebar')
                 ->divider()
                ->route('activity.index'),

            Menu::make('Affiliated Organization')
                ->icon('bs.columns-gap')
                 ->divider()
                ->route('affilatedorganizationcategory.index'),

            Menu::make('Category')
                    
                ->icon('bs.bar-chart')
                ->route('platform.example.charts'),

            Menu::make('Information')
                ->icon('bs.card-text')
                ->route('platform.example.cards')
                ->divider(),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),

            Menu::make('Documentation')
                ->title('Docs')
                ->icon('bs.box-arrow-up-right')
                ->url('https://orchid.software/en/docs')
                ->target('_blank'),

            Menu::make('Changelog')
                ->icon('bs.box-arrow-up-right')
                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
                ->target('_blank')
                ->badge(fn () => Dashboard::version(), Color::DARK),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
