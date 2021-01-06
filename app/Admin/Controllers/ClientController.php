<?php

namespace App\Admin\Controllers;

use App\Models\Client;
use App\Models\Company;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ClientController extends AdminController
{
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
        $grid->column('created_at', __('admin.created_at'));
        $grid->column('updated_at', __('admin.updated_at'));

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
        $show->field('created_at', __('admin.created_at'));
        $show->field('updated_at', __('admin.updated_at'));

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

        $form->text('first_name', __('admin.first_name'));
        $form->text('last_name', __('admin.last_name'));
        $form
            ->multipleSelect('companies', __('admin.companies'))
            ->options(Company::all()->pluck('title', 'id'));

        return $form;
    }
}
