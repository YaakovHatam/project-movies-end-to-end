const App = (function() 
{
    let  serverUrl = '../../Back/API/API.php';
   
    function getServerUrl()
    {
        return serverUrl;
    }

    return {    
        getServerUrl: getServerUrl,
    };

}()); // end of App closure