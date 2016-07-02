<?php

namespace App\Helpers;


class AzureVmOperationsHandler
{
    protected $authenticationToken;
    protected $subscriptionId;
    protected $resourceGroupName;

    protected $url;
    protected $apiVersion;
    protected $resource = 'https://management.core.windows.net/';

    public function __construct($subscriptionId, $resourceGroupName)
    {
        $this->apiVersion = env('AZURE_VM_API', false);
        $this->authenticationToken = AzureAuthenticator::getAuthenticationToken($this->resource);
        $this->subscriptionId = $subscriptionId;
        $this->resourceGroupName = $resourceGroupName;
    }

    public function getAuthenticationToken()
    {
        return $this->authenticationToken;
    }
    
    public function getVMStatus($vm_name)
    {
        foreach($this->getVMInformation($vm_name)->statuses as $status) {
            //TODO remove hardcode
            if( strpos( $status->code, "PowerState" ) === 0 ){
                return $status->displayStatus;
            }
        }
        //TODO maybe handle differently
        return "No status available";
    }

    /**
     * Common requirements as described https://msdn.microsoft.com/en-us/library/azure/mt163630.aspx#bk_common
     * @return resource
     */
    private function prepareStandardCurlRequest()
    {
        $curl = curl_init();
        $auth = 'Authorization:' . $this->authenticationToken->token_type.' '.$this->authenticationToken->access_token;
        $content_type = 'Content-Type: application/json';
        curl_setopt($curl, CURLOPT_HTTPHEADER, [$auth,  $content_type]);
        // Response as string
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // By default https does not work for CURL.
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        return $curl;
    }

    /**
     * Example request url from https://msdn.microsoft.com/en-us/library/azure/mt163682.aspx
     * https://management.azure.com/subscriptions/{subscription-id}/resourceGroups/{resource-group-name}/
     * providers/Microsoft.Compute/virtualMachines/{vm-name}/InstanceView?api-version={api-version}
     *
     * @param $vmName String Name of the virtual machine instance for which to get info
     * @return mixed
     */
    public function getVMInformation($vmName)
    {
        $url = "https://management.azure.com/".
            "subscriptions/$this->subscriptionId/".
            "resourceGroups/$this->resourceGroupName/".
            "providers/Microsoft.Compute/virtualMachines/$vmName/".
            "InstanceView?api-version=$this->apiVersion";
        // Prepare standard request
        $curl = $this->prepareStandardCurlRequest();
        // set url
        curl_setopt($curl, CURLOPT_URL, $url);
        $output = curl_exec($curl);
        curl_close($curl);
        return json_decode($output);
    }

    /**
     * Example request url from https://msdn.microsoft.com/en-us/library/azure/mt163628.aspx
     * https://management.azure.com/subscriptions/{subscription-id}/resourceGroups/{resource-group-name}/
     * providers/Microsoft.Compute/virtualMachines/{vm-name}/start?api-version={api-version}
     *
     * @param $vmName
     * @return mixed
     */
    public function startVM($vmName)
    {
        $url = "https://management.azure.com/".
            "subscriptions/$this->subscriptionId/".
            "resourceGroups/$this->resourceGroupName/".
            "providers/Microsoft.Compute/".
            "virtualMachines/$vmName/".
            "start?api-version=$this->apiVersion";
        $curl = $this->prepareStandardCurlRequest();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "");
        $output = curl_exec($curl);
        $response_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($response_status == '200') {
            return true;
        }
        else {
            return "Status: $response_status\n".$output;
        }
    }

    /**
     * Example request url from https://msdn.microsoft.com/en-us/library/azure/mt163686.aspx
     * https://management.azure.com/subscriptions/{subscription}/resourceGroups/{resourceGroupName}
     * /providers/Microsoft.Compute/virtualMachines/{virtual machinename}/deallocate?api-version={api-version}
     *
     * @param $vmName
     * @return mixed
     */
    public function stopAndDeallocateVM($vmName)
    {
        $url ="https://management.azure.com/".
            "subscriptions/$this->subscriptionId/".
            "resourceGroups/$this->resourceGroupName".
            "/providers/Microsoft.Compute/".
            "virtualMachines/$vmName/".
            "deallocate?api-version=$this->apiVersion";
        $curl = $this->prepareStandardCurlRequest();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "");
        $output = curl_exec($curl);
        $response_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($response_status == '200') {
            return true;
        }
        else {
            return "Status: $response_status\n".$output;
        }
    }
}