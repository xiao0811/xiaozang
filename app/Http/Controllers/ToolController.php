<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Validator;

class ToolController extends Controller
{
    /**
     * 单个图片上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function imageUpload(Request $request)
    {
        $validator = Validator::make($request->file(), [
            "image" => "required|image"
        ], [
            "image.required" => "上传图片不能为空",
            "image.image"    => "图片格式不符合",
        ]);

        if ($validator->fails()) {
            return $this->returnJson([], $validator->errors()->first(), 400);
        }

        $image = $request->file("image");

        if ($image->isValid()) {
            // 生成文件路径-名字
            $filename = Carbon::now()->toDateString() . "/" .   // 日期文件夹
                Str::uuid()->toString() . "." .                 // UUID文件名
                $image->getClientOriginalExtension();           // 扩展名

            // 文件缓存
            $path = $image->getRealPath();

            // 转存storage 文件夹下
            Storage::disk("public")->put($filename, file_get_contents($path));

            return $this->returnJson(["path" => asset('storage/' . $filename)]);
        }
    }

    // 测试
    public function test()
    {
        var_dump(Str::uuid()->toString());
    }
}
