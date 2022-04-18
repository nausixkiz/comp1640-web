<?php

namespace App\Actions\Category;

use Illuminate\Support\Facades\Crypt;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class ExportCategoryToZipAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Export To Zip";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "archive";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param Array $selectedModels Array with all the id of the selected models
     * @param $view Current view where the action was executed from
     */
    public function handle($selectedModels, View $view)
    {
        return redirect()->route('categories.export.zip', [
            'category' => Crypt::encrypt($selectedModels),
        ]);
    }
}
