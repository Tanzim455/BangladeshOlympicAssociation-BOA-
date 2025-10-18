<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;

use App\Models\AffiliatedOrganizationCategory;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Modal;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\TextArea;

class AffiliatedOrganizationCategoryEditScreen extends Screen
{
   /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
     /**
     * @var AboutBoaHistory
     */
    public $activity;
    public $request_id;

    public function __construct(){
         $this->request_id=request()->route('id');
      
    }
     public function query(AffiliatedOrganizationCategory $affiliated_category): iterable
    {
      
         return [
            'affiliated_category' => AffiliatedOrganizationCategory::findOrFail($this->request_id),
             
        ];
    
        
    }
    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Edit Category';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
             Button::make('updateCategory')
                 ->class('btn-primary')
                ->icon('note')
                ->method('updateCategory')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
             Layout::rows([
                Input::make('affiliated_category.name')
                    ->title('Name')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

               

               TextArea::make('affiliated_category.description')
                    ->title('Description'),
    

                

            ])
             ];
    }

    public function updateCategory(Request $request)
    {
         $validate=$request->validate([
            'affiliated_category.name' => 'required',
            'affiliated_category.description' => 'required',
        ]);
        $name=$validate['affiliated_category']['name'];
      
       $description=$validate['affiliated_category']['description'];
        $affiliated_category=AffiliatedOrganizationCategory::findOrFail($this->request_id);
      
         $affiliated_category->update([
            'name' => $name,
            'description' => $description,
        ]);
        return redirect()->route('affilatedorganizationcategory.index');

    }
        
      
            
    }

