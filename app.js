let form = document.querySelector('.form');
let inputs = form.querySelectorAll('input');
let msg = document.querySelector('.msg');

form.addEventListener('submit', function(e){
    e.preventDefault();
    msg.innerHTML = 'Chargement...';

    let xhr = new XMLHttpRequest();
    let data = new FormData(this);

    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4){
            if(xhr.status == 200){
                console.log(xhr.response);
                let res = xhr.response;
                
                if(res.success != false){
                    inputs.forEach(input => {
                        input.value = '';
                    })
                }

                msg.innerHTML = res.msg;

            }else{
                alert('Une erreur est survenue...');
            }
        }
    }

    //initialisation de la requete
    xhr.open('POST', 'php/adduser.php', true);
    xhr.responseType = 'json';

    //Envoie la requête
    xhr.send(data);
})