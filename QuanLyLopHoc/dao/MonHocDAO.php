<?php
require_once __DIR__ . '/../core/BaseDAO.php';
require_once __DIR__ . '/../models/MonHocModel.php';
class MonHocDAO extends BaseDAO {
    protected $table = 'mon_hoc';
    protected $modelClass = 'MonHocModel';
}