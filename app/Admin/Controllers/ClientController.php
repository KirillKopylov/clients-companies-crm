<?php

namespace App\Admin\Controllers;

use App\Models\Client;
use App\Admin\Helpers\AdminHelper;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ClientController extends AdminController
{
    use AdminHelper;

    /**
     * Set title for current resource.
     */
    public function __construct()
    {
        $this->title = __('admin.clients');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new Client());

        $grid->column('id', __('admin.id'));
        $grid->column('first_name', __('admin.first_name'));
        $grid->column('last_name', __('admin.last_name'));
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
        $show = new Show(Client::findOrFail($id));

        $show->field('id', __('admin.id'));
        $show->field('first_name', __('admin.first_name'));
        $show->field('last_name', __('admin.last_name'));
        $show->field('companies', __('admin.companies'))->as(function ($companies) {
            return AdminHelper::formatCompaniesDetail($companies);
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
        $form = new Form(new Client());

        $form
            ->text('first_name', __('admin.first_name'))
            ->rules('required|max:50')
            ->required();
        $form
            ->text('last_name', __('admin.last_name'))
            ->rules('required|max:50')
            ->required();
        $form
            ->multipleSelect('companies', __('admin.companies'))
            ->options(function ($companies) {
                if (!empty($companies)) {
                    return AdminHelper::formatCompaniesOptions($companies);
                }
            })
            ->ajax(route('companies_ajax'));

        return $form;
    }
}
