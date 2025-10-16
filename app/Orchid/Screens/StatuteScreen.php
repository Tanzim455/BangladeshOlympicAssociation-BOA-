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
                    ->help('Specify a short descriptive title for this post.'),

               

              

               Input::make('statute.file')->type('file'),

            ]),
            
        ]) ->size(Modal::SIZE_LG),
        StatuteLayout::class,
             
        ];
        
    }
    public function createOrUpdate(Request $request)
    {
               
        $validate= $request->validate([
            'statute.title' => 'required',
          
        ]);
        $request_all=$request->all();
        $requested_file=$request_all['statute']['file'];
      
       $path = "pdfs";
    $file = new File($requested_file);
 
    $attachment = $file->path($path)->load();
        
        $this->statute->fill($request->get('statute'))->save();

        Alert::info('Statute has been successfully created');

        return redirect()->route('statute.index');
    }
    public function remove(Request $request)
    {
         
        Statute::findOrFail($request->get('id'))->delete();

        Alert::info('You have successfully deleted the post.');

        return redirect()->route('about.boa.history');
    }
}
