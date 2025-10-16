<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;


use App\Models\Activity;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Modal;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

class ActivityEditScreen extends Screen
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
     public function query(Activity $activity): iterable
    {
      
         return [
            'about_boa_mission' => Activity::findOrFail($this->request_id),
             
        ];
    
        
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Edit Activity';
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
                 ->class('btn-primary')
                ->icon('note')
                ->method('updateActivity')
                
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [];
    }
}
