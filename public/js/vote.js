
let bodyElt = document.body;
let increaseElt = document.getElementById("countLike");
let decreaseElt = document.getElementById("countDislike");
let textLike = document.getElementById("like");
let textDislike = document.getElementById("dislike");
let plusElt = document.getElementById("add");
let minusElt= document.getElementById("remove");

//console.log(increaseElt);
//console.log(decreaseElt );
console.log(textDislike);
console.log(textLike);
//console.log(plusElt);
//console.log(minusElt);

plusElt.addEventListener("click",function (e) {
      e.preventDefault();
      let nbre = increaseElt.textContent;
     let link = `{{ path('vote', { somme : ${nbre}  }) }}`;
      fetch(`${link}`)
          .then(response => response.json())
          .then(data => {

                console.log(data);
          })
          .catch(error => console.log(error))
          .finally(() => console.log('fini'));

})