<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use App\Admin\Helpers\AdminHelper;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Controllers\AdminController;

class CompanyController extends AdminController
{
    use AdminHelper;

    /**
     * Set title for current resource.
     */
    public function __construct()
    {
        $this->title = __('admin.companies');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Company());

        $grid->column('id', __('admin.id'));
        $grid->column('title', __('admin.title'));
        $grid->column('created_at', __('admin.created_at'))->display(function ($createdAt) {
            return AdminHelper::formatDate($createdAt);
        });
        $grid->column('updated_at', __('admin.updated_at'))->display(function ($updatedAt) {
            return AdminHelper::formatDate($updatedAt);
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id): Show
    {
        $show = new Show(Company::findOrFail($id));

        $show->field('id', __('admin.id'));
        $show->field('title', __('admin.title'));
        $show->field('clients')->as(function ($clients) {
            return AdminHelper::formatClientsDetail($clients);
        });
        $show->field('created_at', __('admin.created_at'))->as(function ($createdAt) {
            return AdminHelper::formatDate($createdAt);
        });
        $show->field('updated_at', __('admin.updated_at'))->as(function ($updatedAt) {
            return AdminHelper::formatDate($updatedAt);
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new Company());

        $form
            ->text('title', __('admin.title'))
            ->rules('required|max:255')
            ->required();
        $form
            ->multipleSelect('clients', __('admin.clients'))
            ->options(function ($clients) {
                if (!empty($clients)) {
                    return AdminHelper::formatClientsOptions($clients);
                }
            })
            ->ajax(route('clients_ajax'));

        return $form;
    }
}
