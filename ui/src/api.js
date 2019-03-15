let domains = 'https://www.malczewski.it/itr/';
let version = 'v1'

function url(module, resource){
    return module+'/'+resource;
}

let urlMap = {
    'host':domains,
    'root':domains+'api/'+version,
    'form_data':url('provider','form-data'),
    'create_request':url('recommendation','create-request')
};

export default urlMap;