let domains = 'https://www.malczewski.it/itr/';
let version = 'v1'

function url(module, resource){
    return module+'/'+resource;
}

let urlMap = {
    'host':domains,
    'headers':{
        'Access-Control-Allow-Origin': '*',
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    'root':domains+'api/'+version,
    'form_data':url('provider','form-data')
};

export default urlMap;