<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\AboutBoaHistory;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Modal;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;



class AboutBoaHistoryEditScreen extends Screen
{
    /**
     * @var AboutBoaHistory
     */
    public $about_boa_history;
    public $request_id;

    public function __construct(){
         $this->request_id=request()->route('id');
      
    }

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
            'about_boa_history' => AboutBoaHistory::findOrFail($this->request_id),
             
        ];
    
        
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Edit History';
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
                ->method('updateHistory')
                
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
                Input::make('about_boa_history.title')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

               

              

                Quill::make('about_boa_history.description')
                    ->title('Main text'),

            ])
             ];
    }

    public function updateHistory(Request $request)
    {
         $validate=$request->validate([
            'about_boa_history.title' => 'required',
            'about_boa_history.description' => 'required',
        ]);
        $title=$validate['about_boa_history']['title'];
       $description=$validate['about_boa_history']['description'];
        $about_boa_history=AboutBoaHistory::findOrFail($this->request_id);
      
        $about_boa_history->update([
            'title' => $title,
            'description' => $description,
        ]);

        return redirect()->route('about.boa.history');
      
            
    }

}
