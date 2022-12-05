<?php
error_reporting(0);
include("controller/controller.php");
$controller = new controller();

if(isset($_GET['param']))
{

if($_GET['param']=='index'){
$controller ->index();
}
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
elseif($_GET['param']== 'loginAction'){
    $controller->get_login();
}
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
elseif($_GET['param']== 'dashboard1'){
    $controller->dashboard1();
}
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
elseif($_GET['param']=="servicedashboard"){
	$controller->servicedashboard();
}
//:::::::::::::::::::::::::::::::  for customerdashboard   :::::::::::::::::::::::::::::::::::::::::::::::::::::
    elseif($_GET['param']=="customerdashboard"){
        $controller->customerdashboard();
    }
//::::::::::::::::::::::::::::::: for signup ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    elseif($_GET['param']=='signup'){
        $controller->signup();
    }
//::::::::::::::::::::::::::::::: for signup :::::::::::::::::::::::::::::::::::::::::::::::::::
    // elseif($_GET['param']=='signup'){
    //     $controller->signup();
    // }
//::::::::::::::::::::::::::::::: for signup Action ::::::::::::::;:::::::::::::::::::::::::::::
   elseif($_GET['param']=='signupAction'){
            $controller->signupAction();
        }
//::::::::::::::::::::::::::::::: for thankyou for signup ::::::::::::::::::::::::::::::::::::::
    elseif($_GET['param']=='thankYou'){
        $controller->thankYou();
    }
//::::::::::::::::::::::::::::::: for verification for signup ::::::::::::::::::::::::::::::::::
    elseif($_GET['param']=='verify'){
        $controller->Verify();
    } 

//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
elseif($_GET['param']=='serviceResourceReq'){
    $controller->serviceResourceReq();
} 
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
elseif($_GET['param']=='data4Reply'){
    $controller->data4Reply();
} 
//:::::::::::::::::::::::: for serviceResourceReq operations ::::::::
elseif($_GET['param']=='modelReply'){
    $controller->modelReply();
} 
//:::::::::::::::::::::::: for serviceMyResponse  ::::::::
    elseif($_GET['param']=='serviceMyResponse'){
        $controller->serviceMyResponse();
    } 
//:::::::::::::::::::::::: for serviceprofile  ::::::::
    elseif($_GET['param']=='serviceprofile'){
        $controller->serviceprofile();
    } 
//:::::::::::::::::::::::: for serviceprofile Action  ::::::::
    elseif($_GET['param']=='editUserProfile'){
        $controller->editUserProfile();
    } 
//:::::::::::::::::::::::: for serviceSetting  ::::::::
    elseif($_GET['param']=='serviceSetting'){
        $controller->serviceSetting();
    } 
//:::::::::::::::::::::::: for logout  ::::::::
    elseif($_GET['param']=='logout'){
        $controller->logout();
    }
//:::::::::::::::::::::::: for customerAddRequest  ::::::::
    elseif($_GET['param']=='customerAddRequest'){
        $controller->customerAddRequest();
    } 
//:::::::::::::::::::::::: for c_AddRequestAction  ::::::::
 elseif($_GET['param']=='c_AddRequestAction'){
       $controller->c_AddRequestAction();
    // echo "yo";  
  }
//:::::::::::::::::::::::: for customerDeals  ::::::::
    elseif($_GET['param']=='customerDeals'){
        $controller->customerDeals();  
   }
//:::::::::::::::::::::::: for customerDeals Action  ::::::::
    elseif($_GET['param']=='customerAproveDeal'){
        $controller->customerAproveDeal();  
   }
//:::::::::::::::::::::::: for customerDeleteDeal Action  ::::::::
    elseif($_GET['param']=='customerDeleteDeal'){
        $controller->customerDeleteDeal();  
        // echo 'you';
   }
//:::::::::::::::::::::::: for customerSendRequest ::::::::
    elseif($_GET['param']=='customerSendRequest'){
        $controller->customerSendRequest();  
   }
//:::::::::::::::::::::::: for customerDeleteSendReq ::::::::
    elseif($_GET['param']=='customerDeleteSendReq'){
        $controller->customerDeleteSendReq ();  
   }
//::::::::::::::::::::::::: for customerSeeAprovedDeals
elseif($_GET['param']=='customerSeeAprovedDeals'){
    $controller->customerSeeAprovedDeals();
}
//::::::::::::::::::::::::: for customerProfile
elseif($_GET['param']=='customerProfile'){
    $controller->customerProfile();
}
//::::::::::::::::::::::::: for customerSetting
elseif($_GET['param']=='customerSetting'){
    $controller->customerSetting();
}
//::::::::::::::::::::::::: for customerNotification
elseif($_GET['param']=='customerNotification'){
    $controller->customerNotification();
}
//::::::::::::::::::::::::: for forgot
elseif($_GET['param']=='forgot'){
    $controller->forgot();
}
//::::::::::::::::::::::::: for forgot operation->emailCheck
elseif($_GET['param']=='emailCheck'){
    $controller->emailCheck();
}
//::::::::::::::::::::::::: for forgot operation->password reset page
elseif($_GET['param']=='PasswordReset'){
    $controller->passwordresetpage();
}
//::::::::::::::::::::::::: for forgot operation->setpassword
elseif($_GET['param']=='resetPass'){
    $controller->resetPass();
}
//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
}
?>