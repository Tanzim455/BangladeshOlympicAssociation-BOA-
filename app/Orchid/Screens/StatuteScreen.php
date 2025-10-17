<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Statute;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;

use Orchid\Screen\Fields\Attach;

use Illuminate\Http\Request;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Attachment\File;
use App\Orchid\Layouts\StatuteLayout;

use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\CheckBox;


class StatuteScreen extends Screen
{
   /**
     * @var AboutBoaMission
     */
     public $statute;

    /**
     * Query data.
     *
     * @param Statute $statute;
     * @param Request $request;
     *
     * @return array
     */
      
    public function query(Statute $statute): iterable
    {
        $statute->load('attachments');
      
         return [
            'statute' => $statute,
             'statutes' => Statute::paginate(),
        ];
    
        
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Statute';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
   public function commandBar(): iterable
    {
        return [
           
                 ModalToggle::make('Add Statute')
            ->modal('Add Statute')
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
            Layout::modal('Add Statute', [
            Layout::rows([
                Input::make('statute.title')
                    ->title('Title')
                     
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short  title for this post.'),

               
                         Upload::make('statute.attachments')
                         ->groups('pdf')
                          ->title('All files')
                        ->acceptedFiles('.pdf')
                        ->maxSize(5120),// 5MB
                       
                        CheckBox::make('statute.is_active')
    ->value(1)
    ->title('Is Active')
    ->placeholder('Is active')
  
               
              

               

            ]),
            
        ]) ->size(Modal::SIZE_LG),
        StatuteLayout::class,
             
        ];
        
    }
    public function createOrUpdate(Request $request)
    {
              
        $validate= $request->validate([
            'statute.title' => 'required',
            'statute.attachments' => 'required',
            'statute.is_active'=>'nullable|boolean'
        ]);
        
        $request_statute=$request->get('statute');
        
        if(isset($request_statute['statute.is_active'])){
            Statute::where('is_active', 1)->update(['is_active' => 0]);
        }
        $this->statute->fill($request->get('statute'))->save();
        if (isset($this->statute)) {
            $this->statute->attachments()->syncWithoutDetaching(
                $request->input('statute.attachments', [])
            );
        }

        Alert::info('Statute has been successfully created');

        return redirect()->route('statute.index');
    }
    public function remove(Request $request)
    {
         
        Statute::findOrFail($request->get('id'))->delete();

        Alert::info('You have successfully deleted the statute.');

        return redirect()->route('statute.index');
    }
}
