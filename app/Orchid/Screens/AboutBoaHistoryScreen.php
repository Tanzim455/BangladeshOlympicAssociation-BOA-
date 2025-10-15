<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Quill;
use App\Models\AboutBoaHistory;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;
use App\Orchid\Layouts\AboutBoaHistoryListLayout;

use Orchid\Screen\Layouts\Modal;

class AboutBoaHistoryScreen extends Screen
{
    /**
     * @var AboutBoaHistory
     */
    public $about_boa_history;

    /**
     * Query data.
     *
     * @param AboutBoaHistory $about_boa_history;
     * @param Request $request;
     *
     * @return array
     */
    public function query(AboutBoaHistory $about_boa_history): iterable
    {
      
         return [
            'about_boa_history' => $about_boa_history,
             'about_boa_histories' => AboutBoaHistory::paginate(),
        ];
    
        
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'History';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
           
                 ModalToggle::make('Add History')
            ->modal('Add History')
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
            Layout::modal('Add History', [
            Layout::rows([
                Input::make('about_boa_history.title')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

               

              

                Quill::make('about_boa_history.description')
                    ->title('Main text'),

            ])
        ]) ->size(Modal::SIZE_LG),
            AboutBoaHistoryListLayout::class
        ];
        
    }
    /**
 * Get the validation rules that apply to save/update.
 *
 * @return array
 */

     public function createOrUpdate(Request $request)
    {
        $request->validate([
            'about_boa_history.title' => 'required',
            'about_boa_history.description' => 'required',
        ]);

        $this->about_boa_history->fill($request->get('about_boa_history'))->save();

        Alert::info('You have successfully created a post.');

        return redirect()->route('about.boa.history');
    }
  
    public function remove(Request $request)
    {
         
        AboutBoaHistory::findOrFail($request->get('id'))->delete();

        Alert::info('You have successfully deleted the post.');

        return redirect()->route('about.boa.history');
    }
    
}
