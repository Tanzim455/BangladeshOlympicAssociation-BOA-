<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use App\Models\AboutBoaHistory;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;

class AboutBoaHistoryListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'about_boa_histories';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
     public function query(AboutBoaHistory $about_boa_history): iterable
    {
      
         return [
            'about_boa_history' => $about_boa_history,
             
        ];
    
        
    }
       public function columns(): array
    {
        return [
            TD::make('id', 'ID'),
              TD::make('title', 'Title')
                ->render(function (AboutBoaHistory $about_boa_history) {
                    return Link::make($about_boa_history->title);
                }),
            TD::make('description', 'Description'),
               
            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
            TD::make(__('Actions'))
                
                ->render(fn (AboutBoaHistory $about_boa_history) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            
                            ->icon('bs.pencil')
                            ->route('about.boa.history.edit', [
                                'id' => $about_boa_history->id,
                            ])
                            ,

                        Button::make(__('Delete'))
                        
                            ->icon('bs.trash3')
                        ->method('remove', [
                    'id' => $about_boa_history->id,
                ]),
                           
                    ])),
        ];
    }
}
