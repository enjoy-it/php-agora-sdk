<?php

namespace EchoZjs\Agora\Auth;

use EchoZjs\Agora\Agora;
use EchoZjs\Agora\Api;

class SimpleTokenBuilder extends Api
{
    const AttendeePrivileges = array(
        AccessToken::Privileges["kJoinChannel"]        => 0,
        AccessToken::Privileges["kPublishAudioStream"] => 0,
        AccessToken::Privileges["kPublishVideoStream"] => 0,
        AccessToken::Privileges["kPublishDataStream"]  => 0
    );

    const PublisherPrivileges = array(
        AccessToken::Privileges["kJoinChannel"]              => 0,
        AccessToken::Privileges["kPublishAudioStream"]       => 0,
        AccessToken::Privileges["kPublishVideoStream"]       => 0,
        AccessToken::Privileges["kPublishDataStream"]        => 0,
        AccessToken::Privileges["kPublishAudioCdn"]          => 0,
        AccessToken::Privileges["kPublishVideoCdn"]          => 0,
        AccessToken::Privileges["kInvitePublishAudioStream"] => 0,
        AccessToken::Privileges["kInvitePublishVideoStream"] => 0,
        AccessToken::Privileges["kInvitePublishDataStream"]  => 0
    );

    const SubscriberPrivileges = array(
        AccessToken::Privileges["kJoinChannel"]               => 0,
        AccessToken::Privileges["kRequestPublishAudioStream"] => 0,
        AccessToken::Privileges["kRequestPublishVideoStream"] => 0,
        AccessToken::Privileges["kRequestPublishDataStream"]  => 0
    );

    const AdminPrivileges = array(
        AccessToken::Privileges["kJoinChannel"]         => 0,
        AccessToken::Privileges["kPublishAudioStream"]  => 0,
        AccessToken::Privileges["kPublishVideoStream"]  => 0,
        AccessToken::Privileges["kPublishDataStream"]   => 0,
        AccessToken::Privileges["kAdministrateChannel"] => 0
    );

    const Role = array(
        "kRoleAttendee"   => 0,  // for communication
        "kRolePublisher"  => 1, // for live broadcast
        "kRoleSubscriber" => 2,  // for live broadcast
        "kRoleAdmin"      => 101
    );

    const RolePrivileges = array(
        self::Role["kRoleAttendee"]   => self::AttendeePrivileges,
        self::Role["kRolePublisher"]  => self::PublisherPrivileges,
        self::Role["kRoleSubscriber"] => self::SubscriberPrivileges,
        self::Role["kRoleAdmin"]      => self::AdminPrivileges
    );

    public $token;

    public function __construct(Agora $app)
    {
        parent::__construct($app);

        $this->token                 = new AccessToken();
        $this->token->appID          = $app->getConfig('id');
        $this->token->appCertificate = $app->getConfig('secret');
    }

    public function initWithToken($token, $appCertificate, $channel, $uid)
    {
        $this->token = AccessToken::initWithToken($token, $appCertificate, $channel, $uid);
    }

    public function initPrivilege($role)
    {
        $p = self::RolePrivileges[$role];
        foreach ($p as $key => $value) {
            $this->setPrivilege($key, $value);
        }
    }

    public function setPrivilege($privilege, $expireTimestamp)
    {
        $this->token->addPrivilege($privilege, $expireTimestamp);
    }

    public function removePrivilege($privilege)
    {
        unset($this->token->message->privileges[$privilege]);
    }

    public function buildToken($channelName, $uid)
    {
        $this->token->channelName = $channelName;
        $this->token->setUid($uid);
        return $this->token->build();
    }
}