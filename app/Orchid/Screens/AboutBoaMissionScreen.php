<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\AboutBoaMission;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use App\Orchid\Layouts\AboutBoaHistoryListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;


class AboutBoaMissionScreen extends Screen
{
    /**
     * @var AboutBoaMission
     */
    public $about_boa_mission;

    /**
     * Query data.
     *
     * @param AboutBoaMission $about_boa_history;
     * @param Request $request;
     *
     * @return array
     */
    public function query(AboutBoaMission $about_boa_mission): iterable
    {
      
         return [
            'about_boa_mission' => $about_boa_mission,
             'about_boa_missions' => AboutBoaMission::get(),
        ];
    
        
    }
    public function name(): ?string
    {
        return 'Mission';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
           
                 ModalToggle::make('Add Mission')
            ->modal('Add Mission')
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
            Layout::modal('Add Mission', [
            Layout::rows([
                Input::make('about_boa_mission.title')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

               

              

                Quill::make('about_boa_mission.description')
                    ->title('Main text'),

            ])
        ]) ->size(Modal::SIZE_LG),
            // AboutBoaHistoryListLayout::class
        ];
        
    }
    public function createOrUpdate(Request $request)
    {
        $request->validate([
            'about_boa_mission.title' => 'required',
            'about_boa_mission.description' => 'required',
        ]);

        $this->about_boa_mission->fill($request->get('about_boa_mission'))->save();

        Alert::info('Boa Mission has been successfully created');

        return redirect()->route('about.boa.mission');
    }
}
