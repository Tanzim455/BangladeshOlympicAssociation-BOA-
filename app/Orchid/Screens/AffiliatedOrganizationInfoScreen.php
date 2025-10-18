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
use App\Models\AffiliatedOrganizationInfo;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\CheckBox;

// use App\Orchid\Layouts\ActivityLayout;
use Orchid\Screen\Fields\Attach;
use Orchid\Attachment\File;
use Orchid\Screen\Fields\Select;



class AffiliatedOrganizationInfoScreen extends Screen
{
    /**
     * @var AffiliatedOrganizationInfo
     */
    public $affiliated_organization_info;

    /**
     * Query data.
     *
     * @param AboutBoaMission $about_boa_history;
     * @param Request $request;
     *
     * @return array
     */
    public function query(AffiliatedOrganizationInfo $affiliated_organization_info): iterable
    {
        return [
            'affiliated_organization_info'=>$affiliated_organization_info,
            'affiliated_organization_infos' => AffiliatedOrganizationInfo::paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Affiliated Organization Info';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
              ModalToggle::make('Add Affiliated Organization Info')
                 
            ->modal('Add Affiliated Organization Info')
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
            Layout::modal('Add Affiliated Organization Info', [
            Layout::rows([
                Input::make('affiliated_organization_info.name')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),
                   Upload::make('affiliated_organization_info.attachments')
    ->type('file')
    ->title('Logo')
    ->acceptedFiles('.jpg,.jpeg,.png')
    ->maxSize(5120) // 5MB
   ,
                       
                         Input::make('affiliated_organization_info.president_name')
                    ->title('Presidents Name')
                    ->placeholder('Presidents Name')
                    ->help('Specify a short descriptive title for this post.'),
                     Upload::make('affiliated_organization_info.president_image')
                       
                          ->title('President Photo')
                           ->acceptedFiles('.jpg,.jpeg,.png')
                        ->maxSize(5120) // 5MB
                      ,
                        Input::make('affiliated_organization_info.gs_name')
                    ->title('General Secretary Name')
                    ->placeholder('Enter General Secretary Name'),
                   
                     Upload::make('affiliated_organization_info.gs_image')
                       
                          ->title('General Secreatry Photo')
                           ->acceptedFiles('.jpg,.jpeg,.png')
                        ->maxSize(5120) // 5MB
                      ,
                      Quill::make('affiliated_organization_info.description')
                    ->title('Description'),
                     Input::make('affiliated_organization_info.address')
                    ->title('Address')
                    ->placeholder('Enter Address'),
                   
                     Input::make('affiliated_organization_info.phone')
                    ->title('Phone Number')
                    ->placeholder('Enter phone number'),
                   
                     Input::make('affiliated_organization_info.email')
                    ->title('Email')
                    ->placeholder('Enter email address'),
                   
                     Input::make('affiliated_organization_info.website')
                    ->title('Website')
                    ->placeholder('Enter website link'),
                     Input::make('affiliated_organization_info.facebook_link')
                    ->title('Facebook Link')
                    ->placeholder('Enter Facebook link'),
                     Input::make('affiliated_organization_info.youtube_link')
                    ->title('YouTube Link')
                    ->placeholder('Enter YouTube link'),
                    Input::make('affiliated_organization_info.instagram_link')
                    ->title('Instagram Link')
                    ->placeholder('Enter Instagarm link'),
                   Select::make('affiliated_organization_info.affiliated_organization_category_id')
                   ->title('Select a Category')
    ->fromModel(AffiliatedOrganizationCategory::class, 'name')

               
    

              

            //    AffiliatedOrganizationCategoryLayout::class,

            ]),
           
            
        ]) ->size(Modal::SIZE_LG),
            //  AffiliatedOrganizationCategoryLayout::class,
            
        ];
        
    }

    public function createOrUpdate(Request $request)
    {
        
        $request_activity=$request->get('affiliated_organization_info');
        $this->affiliated_organization_info->fill($request_activity)->save();
           
               if (isset($this->affiliated_organization_info)) {
            $this->affiliated_organization_info->attachments()->syncWithoutDetaching(
                $request->input('affiliated_organization_info.attachments', [])
            );
           
        }
          
            
        
        Alert::info('Afiiliated organization successfully saved has been successfully created');

        return redirect()->route('affilatedorganizationinfo.index');
     
    }
}
