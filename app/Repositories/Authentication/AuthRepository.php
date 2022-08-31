<?php

namespace App\Repositories\Authentication;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthRepository extends \App\Repositories\BaseRepository implements AuthenticationRepositoryInterface
{
    public function userRegister($data, $id = null)
    {
        DB::beginTransaction();
        try {
            if ($id)
                $content = $this->model->find($id);
            else
                $content = $this->model;

            $content->name = $data['name'];
            $content->email = $data['email'];

            if (isset($data['password']) && !empty($data['password']))
                $content->password = Hash::make($data['password']);

            $content->save();
            DB::commit();
            return $content;
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            return false;
        }
    }

    public function getWithEmail($email)
    {
        return $this->model->where('email',$email)->first();
    }
}
