<?php

namespace App\Models\Users;

use System\Core\Model;
use System\Libraries\Database\DB;

class Login extends Model
{

    /**
     * 
     * @return \System\Libraries\Database\Collection
     */
    public function getListCourses()
    {
        return DB::execute(DB::query()->table('courses'));
    }

    /**
     * 
     * @return mixed
     */
    public function attemp()
    {
        $user = $this->controller->request->getParsedBodyParam('username');
        $pass = $this->controller->request->getParsedBodyParam('password');
        $course = $this->controller->request->getParsedBodyParam('courseid');

        return DB::execute(DB::query()
                                ->table('users')
                                ->where([
                                    ['user', '=', $user],
                                    ['pass', '=', sha1($pass)],
                                    ['course_id', '=', $course]
                        ]))->fetch();
    }

}
