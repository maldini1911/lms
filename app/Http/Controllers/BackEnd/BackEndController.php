<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BackEndController extends Controller
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index()
    {
      if(str_contains(url()->current(), '/admin/users'))
      {

        $titlePage = $this->getClassName();
        $relations = $this->relations_index();
        $folderName = $this->getFolderName();
        $rows = $this->model;
        $rows = $this->filter($rows);
        if(!empty($relations))
        {
            $rows = $rows->with($relations);
        }

        $rows = $rows->where('email', '!=','user@test.com')->where('name', '!=', 'user')->
        where('name', '!=', 'user lms')->paginate(10);
        $routeName = $this->getFolderName();
        return view('Admin.'.$folderName.'.index', compact('rows', 'titlePage', 'routeName'));

      }else{

                $titlePage = $this->getClassName();
                $relations = $this->relations_index();
                $folderName = $this->getFolderName();
                $rows = $this->model;
                $rows = $this->filter($rows);
                if(!empty($relations))
                {
                    $rows = $rows->with($relations);
                }

                $rows = $rows->paginate(10);
                $routeName = $this->getFolderName();
                return view('Admin.'.$folderName.'.index', compact('rows', 'titlePage', 'routeName'));
      }
    }

    public function create($id = null)
    {

      if($id == null)
      {
        $titlePage = $this->getClassName();
        $folderName = $this->getFolderName();
        $routeName = $this->getFolderName();
        return view('Admin.'.$folderName.'.create', compact('titlePage', 'routeName'))
        ->with($this->relations_create_edit());
      }else{
        $titlePage = $this->getClassName();
        $folderName = $this->getFolderName();
        $routeName = $this->getFolderName();
        return view('Admin.'.$folderName.'.create', compact('titlePage', 'routeName', 'id'))
        ->with($this->relations_create_edit());
      }

    }

    public function edit($id)
    {
        $titlePage = $this->getClassName();
        $row = $this->model->findOrfail($id);
        $folderName = $this->getFolderName();
        $routeName = $this->getFolderName();
        return view('Admin.'.$folderName.'.edit', compact('row', 'titlePage', 'routeName'))
        ->with($this->relations_create_edit());;
    }

    public function destroy($id)
    {
        $titlePage = $this->getClassName();
        $rows = $this->model->findOrfail($id)->delete();
        return back();
    }

    protected function getFolderName()
    {
        return strtolower(str_plural(class_basename($this->model)));
    }
    protected function getClassName()
    {
        return str_plural(class_basename($this->model));
    }
    protected function filter($rows)
    {
        return $rows;
    }

    protected function relations_index()
    {
        return [];
    }

    protected function relations_create_edit()
    {
        return [];
    }
}
