var age = document.getElementById("age")

age.addEventListener("change",()=>{

    if(age.value<0)
    {
        document.getElementById("message").innerHTML="Age cannot go below 0"
        document.getElementById("message").style.color="red"
    }

    else if(age.value<40 && age.value>0)
    {
        document.getElementById("message").innerHTML="To be a part of the community, you need to at least 40"
        document.getElementById("message").style.color="black"
    }
    else if(age.value>=40 && age.value<=50)
    {
        document.getElementById("message").innerHTML="You are the youngsters of this community"
        document.getElementById("message").style.color="black"
    }
    else if(age.value>50)
    {
        document.getElementById("message").innerHTML="Top level members of the group" 
         document.getElementById("message").style.color="red"
    }
}
)