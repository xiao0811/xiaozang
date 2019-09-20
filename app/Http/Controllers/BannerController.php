<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Validator;

class BannerController extends Controller
{
    public function index($id = null)
    {
        if ($id == null) {
            // id 不存在返回全部
            $banners = Banner::query()->where("is_show", 1)->get();
            return $this->returnJson($banners);
        } else {
            $banner = Banner::query()->find($id);
            return $this->returnJson($banner);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->post(), [
            "title"   => "required",
            "path"    => "required|url",
            "link"    => "url",
            "is_show" => "integer|between:0,1",
            "type"    => "required|between:1,3",
            "sort"    => "integer|between:1,100",
        ], [
            "title.required"  => "标题不能为空",
            "path.required"   => "图片地址不能为空",
            "path.url"        => "图片地址不能访问",
            "is_show.integer" => "是否显示类型不正确",
            "is_show.between" => "是否显示类型不正确",
            "type.required"   => "类型不能为空",
            "type.between"    => "类型错误",
            "sort.integer"    => "排序必须为整数",
            "sort.between"    => "排序须在1-100之间",
        ]);

        if ($validator->fails()) {
            return $this->returnJson([], $validator->errors()->first(), 400);
        }

        try {
            $banner = Banner::query()->create($request->post());
            return $this->returnJson($banner);
        } catch (\Exception $exception) {
            return $this->returnJson([], "添加失败, 请重试", 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->post(), [
            "path"    => "url",
            "link"    => "url",
            "is_show" => "integer|between:0,1",
            "type"    => "between:1,3",
            "sort"    => "integer|between:1,100",
        ], [
            "path.url"        => "图片地址不能访问",
            "is_show.integer" => "是否显示类型不正确",
            "is_show.between" => "是否显示类型不正确",
            "type.between"    => "类型错误",
            "sort.integer"    => "排序必须为整数",
            "sort.between"    => "排序须在1-100之间",
        ]);

        if ($validator->fails()) {
            return $this->returnJson([], $validator->errors()->first(), 400);
        }

        $banner = Banner::query()->find($id);
        if (empty($banner)) {
            return $this->returnJson([], "banner 不存在", 400);
        }

        try {
            $banner->update($request->post());
            return $this->returnJson($banner);
        } catch (\Exception $exception) {
            return $this->returnJson([], "更新失败, 请重试", 500);
        }
    }

    public function delete($id)
    {
        $banner = Banner::query()->find($id);
        if (empty($banner)) {
            return $this->returnJson([], "banner 不存在", 400);
        }

        try {
            $banner->delete();
            // 删除本地图片?
            return $this->returnJson($banner);
        } catch (\Exception $exception) {
            return $this->returnJson([], "删除失败, 请重试", 400);
        }
    }
}
