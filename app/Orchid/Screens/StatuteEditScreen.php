<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Statute;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;

class StatuteEditScreen extends Screen
{
    public $statute;
    public $request_id;
    public $url;

    public function __construct()
    {
        $this->request_id = request()->route('id');
    }
     
    // ✅ FIXED: PDF FETCHING ONLY
    public function query(Statute $statute): iterable
    {
        $this->statute = Statute::findOrFail($this->request_id)->load('attachments');
        
        return [
            'statute' => $this->statute
        ];
    }

    public function name(): ?string
    {
        return 'Edit Statute';
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Update')
                ->class('btn-primary')
                ->icon('note')
                ->method('updateStatute'),
        ];
    }

    // ✅ FIXED: PDF LINK IN LAYOUT
    public function layout(): iterable
    {
        $attachment = $this->statute?->attachments()->first();
        
        
        return [
            Layout::rows([
                Input::make('statute.title')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),
                    
                Link::make('📄 Current PDF')
                    ->href($attachment->url() ?? 'No PDF')
                    ->target('_blank')
                    ->style('color: #0d6efd; font-weight: 500;'),
                
                
                
            ])
        ];
    }

    public function updateStatute(Request $request)
    {
        $validate = $request->validate([
            'statute.title' => 'required',
        ]);
        
        $statute = Statute::findOrFail($this->request_id);
        $statute->update(['title' => $validate['statute']['title']]);
        
       
        
        
        return redirect()->route('statute.index');
    }
}