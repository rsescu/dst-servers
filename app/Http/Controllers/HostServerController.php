<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HostServerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //
    /* get deployment https://management.core.windows.net/<subscription-id>/services/hostedservices/<cloudservice-name>/deployments/<deployment-name>
     *
     * tunDlWj6xIbQPhAuR+TqQAH69iSzbCndWjZyFTZJViY=       key
     * tunDlWj6xIbQPhAuR%2BTqQAH69iSzbCndWjZyFTZJViY=
     * 89d835ac-98f5-4a97-9389-fe67321c7e09     tenant id
     * 2e973fd7-a805-493c-b42b-260040b83369     client id
     * start vm https://management.azure.com/subscriptions/{subscription-id}/resourceGroups/{resource-group-name}/providers/Microsoft.Compute/virtualMachines/{vm-name}/start?api-version={api-version}
     * 40.114.196.95
     */

    

}

/*https://login.microsoftonline.com/89d835ac-98f5-4a97-9389-fe67321c7e09/oauth2/token
 POST /89d835ac-98f5-4a97-9389-fe67321c7e09/oauth2/token
Host: login.microsoftonline.com
Content-Type: application/x-www-form-urlencoded
Content-Length: 187
Cache-Control: no-cache
Postman-Token: 54980b86-aeda-c0d7-d67c-4655b1888bc9

grant_type=client_credentials&client_id=2e973fd7-a805-493c-b42b-260040b83369&resource=http%253A%252F%252Fdstserverdeploymentapp.azurewebsites.net&client_secret=tunDlWj6xIbQPhAuR%2BTqQAH69iSzbCndWjZyFTZJViY%3D
 */