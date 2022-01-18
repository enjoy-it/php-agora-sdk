<?php
/**
 * @see  Agora云信令
 * @link https://docs.agora.io/cn/Real-time-Messaging/messaging_restful?platform=restful
 */

namespace EchoZjs\Agora;

class Rtm extends Api
{
    /**
     * 发送Rtm Channel消息
     *
     * @param string $token
     * @param int    $uid
     * @param int    $to_uid
     * @param string $message
     * @param bool   $offline      是否开启离线消息。默认值是 false
     * @param bool   $save_history 是否保存为历史消息。默认值是 false
     * @param bool   $wait_for_ack 是否等到 Agora RTM 系统确认消息投递成功之后再返回响应。默认为 false
     *
     * @return array
     */
    public function sendMessage($token, $uid, $to_uid, $message, bool $offline = true, bool $save_history = false, bool $wait_for_ack = false)
    {
        $appid = $this->app->getConfig('id');
        return $this->request('POST', "/project/{$appid}/rtm/users/{$uid}/peer_messages?wait_for_ack={$wait_for_ack}", [
            'destination'                 => $to_uid,
            'enable_offline_messaging'    => $offline,
            'enable_historical_messaging' => $save_history,
            'payload'                     => $message,
        ], [
            'x-agora-token' => $token,
            'x-agora-uid'   => $uid,
        ]);
    }

    /**
     * 发送Rtm Channel消息
     *
     * @param string $token
     * @param int    $uid
     * @param string $channel_name
     * @param string $message
     * @param bool   $save_history
     *
     * @return array
     */
    public function sendChannelMessage($token, $uid, $channel_name, string $message, bool $save_history = false)
    {
        $appid = $this->app->getConfig('id');
        return $this->request('POST', "/project/{$appid}/rtm/users/{$uid}/channel_messages", [
            'channel_name'                => $channel_name,
            'enable_historical_messaging' => $save_history,
            'payload'                     => $message,
        ], [
            'x-agora-token' => $token,
            'x-agora-uid'   => $uid,
        ]);
    }
}