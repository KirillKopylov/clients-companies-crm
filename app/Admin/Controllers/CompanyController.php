<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use App\Models\Client;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyController extends AdminController
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
        $grid = new Grid(new Company());

        $grid->column('id', __('admin.id'));
        $grid->column('title', __('admin.title'));
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
        $show = new Show(Company::findOrFail($id));

        $show->field('id', __('admin.id'));
        $show->field('title', __('admin.title'));
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
        $form = new Form(new Company());

        $form->text('title', __('admin.title'));
        $form
            ->multipleSelect('clients', __('admin.clients'))
            ->options(Client::all()->pluck('first_name', 'id'));

        return $form;
    }
}
