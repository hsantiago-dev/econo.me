//Retorna o token salvo nos cookies do navegador para realizar a requisição
export function getToken(){

    var aux = document.cookie.split(';');
    var token = null;
    aux.forEach(element => {
        if (element.match(new RegExp(/PHPSESSID/g)))
        token = { headers: { 'Authorization': element.replace('PHPSESSID=', '').trim() } };
    });
    return token;
  }