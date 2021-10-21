<?php

namespace App\Models;

use CodeIgniter\Model;

class UniversalModel extends Model
{
    public function gets($tableName,$where,$limit = 0,$offset = 0,$sortField = 'id', $sortOp = 'DESC'){
        return  $this->table($table)->where($where)->limit($limit,$offset)->orderBy($sortField, $sortOp)->get()->getResultArray();
    }
}
