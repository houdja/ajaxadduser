let form = document.querySelector('.form');

form.addEventListener('submit', function(e){
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    let data = new FormData(this);

    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4){
            if(xhr.status == 200){
                console.log(xhr.response);
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