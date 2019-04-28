<?php


namespace app\back\controller;

use think\Controller;
use think\Db;
use fany\Fany;
class BlogController extends Controller
{
    private $tatal_rows = 100;//总数据
    private $pagesize = 3;//默认每页显示的数据
    public function __set($name,$value)
    {
        if (property_exists($name,$value)){
            $this -> $name = $value;
        }
    }
    public function __get($name)
    {
        if (property_exists($name)){
            return $this -> $name;
        }
    }

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
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
        //分页
        $list = Db::table('recommend')->paginate(6);
        $this->assign('list1', $list);
//        $pag  = $this -> paging();
        return $this ->fetch();
    }
    //创建分页
    public function paging()
    {
        $page_html = <<<HTML
        <nav aria-label="Page1 navigation ">
                    <ul class="pagination navp">
                        <li><a href="#">首页</a></li>
HTML;
        $count = ceil($this ->tatal_rows / $this ->pagesize);
        for ($i = 2;$i < $count -1 ; $i++){
            $page_html .= <<<HTML
                <li class="active"><a href="#">2</a></li>
HTML;
        }
        $page_html .= <<<HTML
                <li><a href="#">尾页</a></li>
            </ul>
HTML;
    }
}
