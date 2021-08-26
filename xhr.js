// function getData(){
//     var xhr = new XMLHttpRequest();
//     xhr.open("GET", "places-form-handler.php");
//     xhr.send();
//     xhr.onload = function(){
//         var jsvar = this.response;
//         alert(jsvar);
//     }
// }

for(var i = 0; i < jArr.length; i++){
    console.log(jArr[i]);
}

nearby_list = [...jArr];

function setCookie(cname, cvalue){
    const d = new Date();
    // d.setTime(d.getTime() + (exdays*24*60*60*1000));     //re-add 'exdays' to parameter
    d.setTime(d.getTime() + 120000);     //manually set to expire in 2 minutes
    let expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

var json_str = JSON.stringify(nearby_list);
setCookie("nearby_arr", json_str);

// document.onreadystatechange = () => {
//     if(document.readyState === 'complete') {
//         for(var i = 0; i < jArr.length; i++){
//             console.log(jArr[i]);
//         }
//     }
// };