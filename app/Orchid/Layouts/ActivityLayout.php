<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Activity;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Illuminate\Support\Str;
class ActivityLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'activities';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
               TD::make('Slno')->render(fn (Activity $activity, object $loop) => $loop->index+1),
              TD::make('title', 'Title'),
                
           
             TD::make('Description')->render(fn (Activity   $activity) => Str::substr($activity->description,0,200)),
                TD::make('slug', 'Slug'),
             TD::make('photo', 'Photo')
    ->render(function (Activity $activity) {
        $attachment = $activity->attachments()->first();
        
        if ($attachment) {
            return '<img src="' . $attachment->url() . '" 
                        alt="Photo" 
                        width="50" 
                        height="50" 
                        style="border-radius: 8px; object-fit: cover;">';
        }
        
        return '<span class="text-muted">No Photo</span>';
    }),
     TD::make('Is Active')->render(fn (Activity $activity) => $activity->is_active ? 'Active' : 'Inactive'),
     TD::make('Publishable')->render(fn (Activity $activity) => $activity->publishable ? 'Publishable' : 'Not publishable'),
     
        ];
    }
}
