<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Modal;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use App\Models\AboutBoaMission;


class AboutBoaMissionEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
     /**
     * @var AboutBoaHistory
     */
    public $about_boa_mission;
    public $request_id;

    public function __construct(){
         $this->request_id=request()->route('id');
      
    }
     public function query(AboutBoaMission $about_boa_mission): iterable
    {
      
         return [
            'about_boa_mission' => AboutBoaMission::findOrFail($this->request_id),
             
        ];
    
        
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
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
            Button::make('Update')
                ->icon('note')
                ->method('updateMission')
                
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
                Input::make('about_boa_mission.title')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

               

              

                Quill::make('about_boa_mission.description')
                    ->title('Main text'),

            ])
             ];
    }

    public function updateMission(Request $request)
    {
         $validate=$request->validate([
            'about_boa_mission.title' => 'required',
            'about_boa_mission.description' => 'required',
        ]);
        $title=$validate['about_boa_mission']['title'];
       $description=$validate['about_boa_mission']['description'];
        $about_boa_mission=AboutBoaMission::findOrFail($this->request_id);
      
        $about_boa_mission->update([
            'title' => $title,
            'description' => $description,
        ]);
          
         return redirect()->route('about.boa.mission');
      
            
    }
}
