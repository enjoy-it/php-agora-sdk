<?php

namespace EchoZjs\Agora;

class Channel extends Api
{
    /**
     * 查询某个用户在指定频道中的状态
     *
     * @param string $appid    必填，控制台中项目的 appID
     * @param int    $uid      必填，用户 ID，可以通过 SDK 获取到
     * @param string $cname    必填，channel name，频道名称
     *
     * @return array
     */
    public function getUserProperty($appid, $uid, $cname)
    {
        return $this->request('GET', "/channel/user/property/{$appid}/{$uid}/{$cname}");
    }

    /**
     * 查询频道内的分角色用户列表
     *
     * @param string $appid    必填，控制台中项目的 appID
     * @param string $cname    必填，channel name，频道名称
     *
     * @return array
     */
    public function getUsersProperty($appid, $channel_name)
    {
        return $this->request('GET', "/channel/user/{$appid}/{$channel_name}");
    }

    /**
     * 查询厂商频道列表
     *
     * @param string $appid     必填，控制台中项目的 appID
     * @param int    $page_no   选填，起始页码，默认值为 0
     * @param int    $page_size 选填，每页条数，默认值为 100
     *
     * @return array
     */
    public function getChannelList($appid, $page_no = 0, $page_size = 100)
    {
        return $this->request('GET', "/channel/{$appid}/", [
            'page_no'   => $page_no,
            'page_size' => $page_size,
        ]);
    }

    /**
     * 查询用户是否连麦用户
     *
     * @param string $appid 必填，控制台中项目的 appID
     * @param int    $uid   必填，用户 ID，可以通过 SDK 获取到
     * @param string $cname 必填，channel name，频道名称
     *
     * @return array
     */
    public function checkChannelUserConnectMicrophone($appid, $uid, $cname)
    {
        return $this->request('GET', "/channel/business/hostin/{$appid}/{$uid}/{$cname}");
    }

}