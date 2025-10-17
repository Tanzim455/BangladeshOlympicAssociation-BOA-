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
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Attachment\Models\Attachment;
use Illuminate\Support\Str;

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
    public $activity;
    public $request_id;

    public function __construct(){
         $this->request_id=request()->route('id');
      
    }
     public function query(Activity $activity): iterable
    {
      
         return [
            'activity' => Activity::findOrFail($this->request_id),
             
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
        return [
             Layout::rows([
                Input::make('activity.title')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

               

              

                Quill::make('activity.description')
                    ->title('Description'),
                  Upload::make('activity.attachments')
                       
                          ->title('Photos')
                           ->acceptedFiles('.jpg,.jpeg,.png')
                        ->maxSize(5120) // 5MB
                        ->required(),
                          CheckBox::make('activity.status')
    ->value(1)
    ->title('Is Active')
    ->placeholder('Is active')
    ,
                        CheckBox::make('activity.publishable')
    ->value(1)
    ->title('Publishable')
    ->placeholder('Is publishable')
             ]),
             
            
             ];
    }

    public function updateActivity(Request $request)
    {
       
      $validate =$request->validate([
            'activity.title' => 'required',
            'activity.attachments' => 'required',
            'activity.description' => 'required',
            'activity.status'=>'nullable|boolean',
            'activity.publishable'=>'nullable|boolean',
            
        ]);
        $request_activity=$request->get('activity');
       
          $slug=Str::slug($request_activity['title']);
        $request_activity['slug']= $slug;
        if(!isset($request_activity['status']) ){
            $request_activity['status']=0;
        }
        if(!isset($request_activity['publishable']) ){
            $request_activity['publishable']=0;
        }
      
        $this->activity->fill($request_activity)->save();
        if(isset($request_activity['attachments'])){
          
            if (isset($this->activity)) {
            $this->activity->attachments()->syncWithoutDetaching(
                $request->input('activity.attachments', [])
            );
        }
        }
        

        

        return redirect()->route('activity.index');
    }
}
