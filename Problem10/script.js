let quantity=document.getElementById("quantity");
let error =document.getElementById("error")
let totalfee=document.getElementById("totalfee")
let bonus=document.getElementById("bonus")
let check=document.getElementById("check")
let drop=document.getElementById("drop")
let btn=document.getElementById("btn")
let total=1000
quantity.addEventListener("input", function(){
    if(quantity.value<1)
    {
        error.innerHTML="The value cannot be less 1"
        error.style.color="red";
        quantity.value="1";
       

    }
    else
    {
        
        totalfee.innerHTML=`Total cost ${total*Number(quantity.value)}`

        if(total*Number(quantity.value)>5000)
        {
            bonus.innerHTML="Eligible for bonus"
        }
       
 
        


    }
})
check.addEventListener("change",function(){
        if(check.checked)
        {
            btn.style.display="block"
        }
        else
        {
            btn.style.display="none"
        }
        })
 drop.addEventListener("change",function(){
        if(drop.value=="online")
            { 
                totalfee.innerHTML=`Total cost ${total*Number(quantity.value)+100}`

            }
            else if(drop.value=="campus")
            {
                totalfee.innerHTML=`Total cost ${total*Number(quantity.value)+250}`
            }
        })
