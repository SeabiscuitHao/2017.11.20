<?php
namespace app\admin\controller;
// use app\cate\model\admin as adminModel;
use think\Db;
use app\admin\controller\Common;
class cate extends Common
{
    public function add()
    {
      // $data = [
      //   'username' => input('username'),
      //   'password' => input('password'),
      // ];
      // if (request() -> isPost()) {
      //   $ins = Db::name('cate') -> insert($data);
      //   if ($ins) {
      //     $this -> success('添加管理员成功！','lst');
      //   }else{
      //     $this -> error('添加管理员失败');
      //   }
      // }
      if (request() -> isPost()) {
        $cate = new cateModel();
        $res = $cate -> add_cate(input('post.'));
        if ($res) {
          $this -> success('添加管理员成功！','lst');
        }else{
          $this -> error('添加管理员失败！');
        }
      }
      return $this -> fetch('add');

    }

    public function lst()
    {
      // $list = Db::name('cate') -> paginate(3);
      // $this -> assign('list',$list);

      $cate = new cateModel();
      $cateres = $cate -> paginater();
      $this -> assign('cateres',$cateres);
      return $this -> fetch('lst');
    }

    public function edit()
    {
      // $id = input('id');
      // $cates = Db::name('cate') -> find($id);
      // $data = [
      //   'id' => input('id'),
      //   'username' => input('username'),
      //   'password' => input('password'),
      // ];
      // if (request() -> isPost()) {
      //   $edit = Db::name('cate') -> update($data);
      //   if ($edit) {
      //     $this -> success('修改管理员信息成功！','lst');
      //   }else{
      //     $this -> error('修改管理员信息失败！');
      //   }
      // }
      // $this -> assign('cates',$cates);
      $id = input('id');
      $cates = Db::name('cate') -> find($id);
      if (request() -> isPost()) {
        $cate = new cateModel();
        $data = input('post.');
        if ($cate->save_cate($data,$cates) == '2') {
          $this -> error('管理员名称不能为空');
        }
        if ($cate->save_cate($data,$cates)) {
          $this -> success('修改管理员信息成功!','lst');
        }else {
          $this -> error('修改管理员信息失败！');
        }
      }
      $this -> assign('cates',$cates);
      return $this -> fetch('edit');
    }

    public function del()
    {
      // $id = input('id');
      // $del = Db::name('cate') -> where('id','=',$id) -> delete();
      // if ($del) {
      //   $this -> success('删除管理员成功！','lst');
      // }else{
      //   $this -> error('删除管理员失败！');
      // }
      // return $this -> fetch('del');
      $id = input('id');
      $cate = new cateModel();
      if ($cate -> del_cate($id) == 1) {
        $this -> success('删除管理员成功！','lst');
      }else{
        $this -> error('删除管理员失败！');
      }
    }

    public function logout()
    {
      session(null);
      $this -> success('退出登陆成功！');
    }
}
