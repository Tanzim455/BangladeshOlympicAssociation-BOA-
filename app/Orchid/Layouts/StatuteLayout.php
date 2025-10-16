<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Statute;
use Orchid\Screen\Actions\Link;
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
             TD::make('Slno')->render(fn (Statute  $statute, object $loop) => $loop->index+1),
             TD::make('title', 'Title'),  
            //  TD::make('pdf')->render(fn (Statute  $statute) => $statute->attachments()->first()->url()),
TD::make('pdf', 'PDF File')
            ->render(function (Statute $statute) {
                $attachment = $statute->attachments()->first();
                
                if ($attachment) {
                    return Link::make('📄 PDF')
                        ->href($attachment->url())
                        ->target('_blank')
                      
                        ->style('color: #0d6efd; font-weight: 500;');
                }
                
                return '<span class="text-muted">No PDF</span>';
            }),
               
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