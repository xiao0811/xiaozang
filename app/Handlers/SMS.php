<?php

namespace App\Handlers;

use App\Models\SmsLog;
use GuzzleHttp\Client;

class SMS extends BaseHandler
{
    public function send($phone, $message)
    {
        $client = new Client();

        $url  = "http://www.jianzhou.sh.cn/JianzhouSMSWSServer/http/sendBatchMessage";
        $data = [
            "account"    => config("sms.jianzhou.account"),
            "password"   => config("sms.jianzhou.password"),
            "destmobile" => $phone,
            "msgText"    => $message . config("sms.jianzhou.sign"),
        ];

        $response = $client->post($url, ["form_params" => $data]);

        $result = $response->getBody()->getContents();
        if ($result > 0) {
            SmsLog::query()->create([
                "phone"   => $phone,
                "content" => $message,
                "type"    => SmsLog::TYPE_LOGIN,
            ]);
            return $this->returnArray($result, "发送成功");
        } else {
            return $this->returnArray($response, "发送失败", 1);
        }
    }
}
