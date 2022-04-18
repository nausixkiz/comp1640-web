<?php

namespace App\Http\Livewire;

use App\Actions\Category\DeleteCategoryAction;
use App\Actions\Category\EditCategoryAction;
use App\Actions\Category\ExportCategoryToCSVAction;
use App\Actions\Category\ExportCategoryToZipAction;
use App\Models\Category;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class CategoryTableView extends TableView
{
    public $searchBy = ['name', 'id'];
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Category::class;
    protected $paginate = 10;

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [Header::title('Id')->sortBy('id'), 'Name', 'Status', 'Created Date', 'Updated Date'];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->id,
            $model->name,
            $model->hasExpired() ? UI::icon('x', 'danger') : UI::icon('check', 'success'),
            $model->created_at->diffforHumans(),
            $model->updated_at->diffforHumans()
        ];
    }

    protected function repository()
    {
        return Category::query();
    }

    /** For actions by item */
    protected function actionsByRow()
    {
        return [
            new RedirectAction('categories.edit', 'Edit Category', 'edit'),
            new DeleteCategoryAction(),
        ];
    }

    /** For bulk actions */
    protected function bulkActions()
    {
        return [
            new ExportCategoryToCSVAction(),
            new ExportCategoryToZipAction(),
        ];
    }
}
