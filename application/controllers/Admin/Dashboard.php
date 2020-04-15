<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        $models = array(
            'Admin/Users_model'      => 'mUser',
            'Admin/Publishers_model' => 'mPub',
            'Admin/Event_model'      => 'mEvent',
            'Admin/Inbox_model'      => 'mInbox',
            'Admin/News_model'       => 'mNews',
            'Admin/Visitor_model'    => 'mVisitor'
        );
        $this->load->model($models);
    }

    public function index()
    {
        $data = array(
            'title'          => 'Dashboard', 
            'total_user'     => count($this->mUser->getAll()),
            'total_pub'      => count($this->mPub->getAll()),
            'total_event'    => count($this->mEvent->getApproved()),
            'total_chrome'   => count($this->mVisitor->getChrome()),
            'total_firefox'  => count($this->mVisitor->getFirefox()),
            'total_opera'    => count($this->mVisitor->getOpera()),
            'total_other'    => count($this->mVisitor->getOther()),
            'inbox'          => $this->mInbox->getLatestInbox(),
            'events'         => $this->mEvent->getLatestEvent(),
            'artikels'       => $this->mNews->getPopularNews(),
            'statistik'      => $this->mVisitor->visitorGraph(),
            'totalVisitor'   => $this->mVisitor->countAll(),
            'user_this_day'  => $this->mUser->countUserThisDay(),
            'pub_this_day'   => $this->mPub->countPubThisDay(),
            'event_this_day' => $this->mEvent->countEventThisDay(),
        );
        $this->load->view('_admin/dashboard/v_dashboard',$data);
    }

}