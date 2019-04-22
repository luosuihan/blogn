<?php


namespace app\back\controller;

use think\Controller;
use think\Db;

class BlogController extends Controller
{
    public function createAction()
    {
//        return "hello -- create thinkphp";
        //最新文章
        $res = Db::table('latest')
            ->order('id asc')
            ->select();
        $this -> assign('result',$res);
        //热门标签
        $label = Db::table('popularbar')
            ->where('id','<',12)
            ->select();
        $this -> assign('labelres',$label);
        //友情链接
        $link = Db::table('link')
            ->select();
        $this -> assign('linkres',$link);
//        dump(ROOT_PATH);recommend
        //// 查询状态为1的用户数据 并且每页显示10条数据
//        $list = Db::name('recommend')>paginate(6);
        $list = Db::table('recommend')->paginate(10);
        dump($list);
// 把分页数据赋值给模板变量list
        $this->assign('list', $list);
        return $this ->fetch();
    }
}
