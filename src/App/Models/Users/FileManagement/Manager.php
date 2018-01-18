<?php

namespace App\Models\Users\FileManagement;

use System\Core\Model;
use SplStack;
use Illuminate\Database\QueryException;
use Illuminate\Database\Capsule\Manager as DB;

class Manager extends Model
{

    /** @var string|integer */
    protected $user_id = null;

    /**
     * 
     * @param mixed $id
     * @return $this
     */
    public function setUserId($id)
    {
        $this->user_id = $id;
        return $this;
    }

    protected function getFilesObject()
    {
        return new Files($this->user_id);
    }

    protected function getExamsObject($category)
    {
        return new Exams($this->user_id, $category);
    }

    public function getTreeView($parent = null)
    {
        $files = $this->getFilesObject();
        $stack = new SplStack();
        $data = [];
        $collect = $files->listFrom($parent)->getIterator();
        $plist = &$data;

        while (1)
        {
            if (!$collect->valid())
            {
                if ($stack->isEmpty())
                {
                    break;
                }
                $pop = $stack->pop();
                $collect = $pop['iter'];
                $plist = &$pop['list'];
            }
            else
            {
                $file = $collect->current();
                $item = (object) [
                            'text' => $file->name,
                            'nodes' => null,
                            'data' => $file,
                            'icon' => ['1' => 'fa fa-folder', '2' => 'fa fa-file-o'][$file->type_id]
                ];

                $plist[] = $item;

                if ($file->c)
                {
                    $stack->push(['list' => &$plist, 'iter' => $collect]);
                    $item->nodes = [];
                    $plist = &$item->nodes;
                    $collect = $files->listFrom($file->id)->getIterator();

                    continue;
                }
            }
            $collect->next();
        }

        return $data;
    }

    public function createFolder($parent_id)
    {
        return $this->getFilesObject()->insert(
                        $this->controller->request->getParsedBody()['name'], $parent_id, $this->user_id, Files::CATEGORY
        );
    }

    public function getCategoryData($id)
    {
        return $this->getFilesObject()->get($id);
    }

    public function updateCategoryData($id)
    {
        return $this->getFilesObject()->update(
                        $id, $this->controller->request->getParsedBody()['name']
        );
    }

    public function deleteCategory($id)
    {
        try
        {
            return $this->getFilesObject()->delete($id);
        }
        catch (QueryException $e)
        {
            return false;
        }
    }

    public function createExam($parent_id, array $data)
    {
        DB::connection()->beginTransaction();

        try
        {
            $file_id = $this->getFilesObject()->insert(
                    $data['name'], $parent_id, $this->user_id, Files::EXAM
            );

            $insert = $this->getExamsObject($parent_id)->insert(
                    $file_id, $data['header'], $data['footer'], array_key_exists('event', $data) ? $data['date'] : NULL
            );

            DB::connection()->commit();

            return $insert;
        }
        catch (QueryException $ex)
        {
            DB::connection()->rollBack();
            return false;
        }
    }

    public function getExamData($parent_id, $id)
    {
        return $this->getExamsObject($parent_id)->get($id);
    }

    public function updateExamData($parent_id, $id, array $data)
    {
        DB::connection()->beginTransaction();

        try
        {
            if (
                    $this->getFilesObject()->update($id, $data['name'])
                    and
                    $this->getExamsObject($parent_id)->update(
                            $id, $data['header'], $data['footer'], array_key_exists('event', $data) ? $data['date'] : NULL
                    )
            )
            {
                DB::connection()->commit();
                return true;
            }

            return false;
        }
        catch (QueryException $ex)
        {
            DB::connection()->rollBack();
            return false;
        }
    }

    public function deleteExam($parent_id, $id)
    {
        DB::connection()->beginTransaction();

        try
        {
            if (
                    $this->getExamsObject($parent_id)->delete($id)
                    and
                    $this->getFilesObject()->delete($id)
            )
            {
                DB::connection()->commit();
                return true;
            }
        }
        catch (QueryException $ex)
        {
            echo $ex->getMessage();
            exit;
            DB::connection()->rollBack();
            return false;
        }
    }

}
