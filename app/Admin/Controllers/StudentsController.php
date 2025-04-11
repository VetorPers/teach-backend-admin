<?php

namespace App\Admin\Controllers;

use App\Models\Student;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;

class StudentsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '学生管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Student);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('username', '用户名');
        $grid->column('name', '姓名');
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function ($filter) {
            // 在这里添加字段过滤器
            $filter->column(1 / 2, function ($filter) {
                $filter->like('username', '用户名');
            });
            $filter->column(1 / 2, function ($filter) {
                $filter->like('name', '姓名');
            });
        });

        $grid->disableExport();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Student::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('username', '用户名');
        $show->field('name', '姓名');
        $show->field('avatar', '头像')->image(env('APP_URL'), 120, 120);
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Student);

        $form->display('id', __('ID'));
        $form->text('username', '用户名')->rules('required|string|max:20');
        $form->text('name', '姓名')->rules('required|string|max:20');
        $form->image('avatar', '头像');
        $form->password('password', '密码')->rules('required|string|min:6|confirmed');
        $form->password('password_confirmation', '确认密码')->rules('required|string|min:6')->default(function ($form) {
            return $form->model()->password;
        });
        $form->display('created_at', __('Created at'));
        $form->display('updated_at', __('Updated at'));

        $form->ignore(['password_confirmation']);

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });

        return $form;
    }
}
