const tombolCari = document.querySelector('.tombol-cari');
const keyword = document.querySelector('.keyword');
const container = document.querySelector('.container');


keyword.addEventListener('keyup', function (){
// cara pertama
//   const xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function(){
//     if(xhr. readyState == 4 && xhr.status==200){
//         container.innerHTML = xhr.responseText;
//     }
//   };
// xhr.open('get','ajax/ajax_cari.php?keyword=' + keyword.value);
// xhr.send();

// cara ke-2
// fetch()
fetch('ajax/ajax_cari.php?keyword=' + keyword.value)
    .then((response) => response.text())
    .then((response) => (container.innerHTML = response));

});





