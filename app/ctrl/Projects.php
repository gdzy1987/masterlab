<?php

namespace main\app\ctrl;

use main\app\model\OriginModel;
use main\app\model\project\ProjectModel;
use main\app\classes\OriginLogic;

class Projects extends BaseUserCtrl
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * index
     */
    public function index()
    {
        $data = [];
        $data['title'] = '项目';
        $data['sub_nav_active'] = 'project';
        $this->render('gitlab/project/main.php', $data);
    }

    public function fetchAll()
    {
        $projectModel = new ProjectModel();
        $projects = $projectModel->getAll();
        $model = new OriginModel();
        $originsMap = $model->getMapIdAndPath();

        foreach ($projects as &$item) {
            $item['path'] = $originsMap[$item['origin_id']];
            $item['create_time'] = format_unix_time($item['create_time'], time());
        }
        unset($item);

        $data['projects'] = $projects;
        $this->ajaxSuccess('success', $data);
    }

    public function test()
    {
        $str='fasdf李健脚本之家：http://www.jb51.net';
        echo mb_substr($str,0,1,'utf-8');//截取头5个字，假定此代码所在php文件的编码为utf-8
    }



}