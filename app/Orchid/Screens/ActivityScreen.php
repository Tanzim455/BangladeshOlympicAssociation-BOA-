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
use App\Models\Activity;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\CheckBox;

use App\Orchid\Layouts\ActivityLayout;
use Orchid\Screen\Fields\Attach;
use Orchid\Attachment\File;
use Illuminate\Support\Str;


class ActivityScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    /**
     * @var Activity
     */
    public $activity;
    public function query(Activity $activity): iterable
    {
        return [
            'activity'=>$activity,
            'activities' => Activity::paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Activity Add';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
           
                 ModalToggle::make('Add Activity')
            ->modal('Add Activity')
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
            Layout::modal('Add Activity', [
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
        ]) ->size(Modal::SIZE_LG),
        ActivityLayout::class,
            
        ];
        
    }
     public function createOrUpdate(Request $request)
    {
              
        
        $request->validate([
            'activity.title' => 'required',
            'activity.attachments' => 'required',
            'activity.description' => 'required',
            'activity.status'=>'nullable|boolean',
            'activity.publishable'=>'nullable|boolean',
            
        ]);
        $request_activity=$request->get('activity');
       
          $slug=Str::slug($request_activity['title']);
        $request_activity['slug']= $slug;
       
         
        $this->activity->fill($request_activity)->save();
        
        if (isset($this->activity)) {
            $this->activity->attachments()->syncWithoutDetaching(
                $request->input('activity.attachments', [])
            );
        }

        Alert::info('Activity has been successfully created');

        return redirect()->route('activity.index');
    }

    public function remove(Request $request)
    {
             Activity::findOrFail($request->get('id'))->delete();

        Alert::info('You have successfully deleted the activity.');

        return redirect()->route('activity.index');
    }

}
