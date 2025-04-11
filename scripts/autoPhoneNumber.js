const phoneNumber = document.getElementById('phone');

phoneNumber.addEventListener('input', (e) => {
    let value=phoneNumber.value.replace(/\D/g, "");
    let formattedValue="";
    for(let i=0; i<value.length; i++){
        if(i==3 ||i==6){
            formattedValue+="-";
        }
        formattedValue+=value[i];
       
    }
    phoneNumber.value=formattedValue.substring(0,12);
    


});