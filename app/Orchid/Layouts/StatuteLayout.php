<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Statute;

class StatuteLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'statutes';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    
     public function query(Statute $statute): iterable
    {
      
         return [
            'statute' => $statute,
             
        ];
    
        
    }
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID'),
             TD::make('title', 'Title'),  
          
               
            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
        //     TD::make(__('Actions'))
                
        //         ->render(fn (AboutBoaHistory $about_boa_history) => DropDown::make()
        //             ->icon('bs.three-dots-vertical')
        //             ->list([

        //                 Link::make(__('Edit'))
                            
        //                     ->icon('bs.pencil')
        //                     ->route('about.boa.history.edit', [
        //                         'id' => $about_boa_history->id,
        //                     ])
        //                     ,

        //                 Button::make(__('Delete'))
                        
        //                     ->icon('bs.trash3')
        //                 ->method('remove', [
        //             'id' => $about_boa_history->id,
        //         ]),
                           
        //             ])),
        // ];
            ];
    
}
}