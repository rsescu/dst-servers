<?php

namespace App\Http\Controllers;

use App\Helpers\AzureVmOperationsHandler;
use App\Host;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class HostsController extends Controller
{
    //TODO nasty!
    protected $turned_off_string = "VM deallocated";
    protected $turned_on_string = "VM running";
    //TODO this is hardcoding and assuming all hosts are azure VM servers
    protected $subscription_id = "c677219f-0cde-4d57-8fc0-272dda524ae9";
    protected $resource_group_name = "DST_dedicated_server";
    protected $vm_operator;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
        $this->vm_operator = new AzureVmOperationsHandler($this->subscription_id, $this->resource_group_name);
    }

    public function index()
    {
        //TODO status needs to be exposed
        $hosts = Host::all();
        $view_hosts = [];
        foreach($hosts as $key => $host){
            $view_hosts[$key] = new \stdClass();
            $view_hosts[$key]->name = $host->name;
            $view_hosts[$key]->status = $this->vm_operator->getVMStatus($host->name);
            if($view_hosts[$key]->status == $this->turned_off_string) {
                $view_hosts[$key]->on = false;
            }
            else if($view_hosts[$key]->status == $this->turned_on_string) {
                $view_hosts[$key]->on = true;
            }
            else {
                $view_hosts[$key]->on = "pending";
            }

        }
        $data = [
            'hosts' => $view_hosts,
        ];

        return view('hosts', $data);
    }

    public function startHost($vmName)
    {
        $this->vm_operator->startVM($vmName);
        return \Redirect::to('hosts');
    }

    public function stopHost($vmName)
    {
        $this->vm_operator->stopAndDeallocateVM($vmName);
        return \Redirect::to('hosts');
    }
}
