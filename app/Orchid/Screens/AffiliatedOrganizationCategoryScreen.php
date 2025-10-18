<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;

use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use App\Models\AffiliatedOrganizationCategory;
use Orchid\Screen\Fields\TextArea;

use App\Orchid\Layouts\AffiliatedOrganizationCategoryLayout;
use Orchid\Screen\Fields\Attach;
use Orchid\Attachment\File;
use Illuminate\Support\Str;

class AffiliatedOrganizationCategoryScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    /**
     * @var Activity
     */
    public $affiliated_category;
    public function query(AffiliatedOrganizationCategory $affiliated_category): iterable
    {
        return [
            'affiliated_category' => $affiliated_category,
            'affiliated_categories' => AffiliatedOrganizationCategory::paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Affiliated Organization Category';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
   public function commandBar(): iterable
    {
        return [
           
                 ModalToggle::make('Add Affiliated Organization Category')
                 
            ->modal('Add Affiliated Organization Category')
            ->method('createOrUpdate')
            ->icon('plus'),

            
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
            Layout::modal('Add Affiliated Organization Category', [
            Layout::rows([
                Input::make('affiliated_category.name')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

               TextArea::make('affiliated_category.description')
                    ->title('Description'),
    

              

            //    AffiliatedOrganizationCategoryLayout::class,

            ]),
           
            
        ]) ->size(Modal::SIZE_LG),
             AffiliatedOrganizationCategoryLayout::class,
            
        ];
        
    }
    public function createOrUpdate(Request $request)
    {
        $request->validate([
            'affiliated_category.name' => 'required',
            'affiliated_category.description' => 'required',
        ]);

        $this->affiliated_category->fill($request->get('affiliated_category'))->save();

        Alert::info('Affiliated Organization Category has been successfully created');

        return redirect()->route('affilatedorganizationcategory.index');
    }
    public function remove(Request $request)
    {
         
         AffiliatedOrganizationCategory::findOrFail($request->get('id'))->delete();

        Alert::info('You have successfully deleted the category.');

        return redirect()->route('affilatedorganizationcategory.index');
    }
}
