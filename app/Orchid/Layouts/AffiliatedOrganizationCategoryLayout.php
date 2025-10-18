<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

use App\Models\AffiliatedOrganizationCategory;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;

class AffiliatedOrganizationCategoryLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'affiliated_categories';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
     public function query(AffiliatedOrganizationCategory $affiliated_category): iterable
    {
      
         return [
            'affiliated_category' => $affiliated_category,
             
        ];
    
        
    }
    protected function columns(): iterable
    {
        return [
              TD::make('Slno')->render(fn (AffiliatedOrganizationCategory $affiliated_category, object $loop) => $loop->index+1),
              TD::make('name', 'Name'),
                
             TD::make('description', 'Description'),
            
               
            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
            TD::make(__('Actions'))
                
                ->render(fn (AffiliatedOrganizationCategory $affiliated_category) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            
                            ->icon('bs.pencil')
                            ->route('affilatedorganizationcategory.edit', [
                                'id' => $affiliated_category->id,
                            ]),

                        Button::make(__('Delete'))
                        
                            ->icon('bs.trash3')
                        ->method('remove', [
                    'id' => $affiliated_category->id,
                ]),
                           
                    ])),
        ];
    }
}
