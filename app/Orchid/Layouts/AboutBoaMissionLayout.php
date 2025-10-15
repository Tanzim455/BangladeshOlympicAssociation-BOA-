<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use App\Models\AboutBoaMission;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;

class AboutBoaMissionLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'about_boa_missions';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
     public function query(AboutBoaMission $about_boa_mission): iterable
    {
      
         return [
            'about_boa_mission' => $about_boa_mission,
             
        ];
    
        
    }
       public function columns(): array
    {
        return [
            TD::make('id', 'ID'),
              TD::make('title', 'Title'),
                
            TD::make('description', 'Description'),
               
            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
            TD::make(__('Actions'))
                
                ->render(fn (AboutBoaMission $about_boa_mission) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            
                            ->icon('bs.pencil')
                            ->route('about.boa.mission.edit', [
                                'id' => $about_boa_mission->id,
                            ])
                            ,

                        Button::make(__('Delete'))
                        
                            ->icon('bs.trash3')
                        ->method('remove', [
                    'id' => $about_boa_mission->id,
                ]),
                           
                    ])),
        ];
    }
}
