<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Log;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class DeleteCategoryAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Delete Category";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "trash-2";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        try {
            $category = Category::findBySlugOrFail($model->slug);
            $category->delete();

            $this->success('Category deleted successfully');

        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            $this->error('Category deletion failed');
        }
    }

    public function getConfirmationMessage($item = null)
    {
        return 'Are you want to delete this category?';
    }
}
