function valid()
{
    var fn =document.getElementById("fn");
    var ln =document.getElementById("ln");



    if(fn.value=="" || ln.value=="")
    {
        alert("Fields are empty");
        document.getElementById("message").innerHTML = "Each field must have characters.";
        return false;
    }
    if(fn.value.length < 2 || ln.value.length < 2)
    {
        alert("Less than 2 char");
        document.getElementById("message").innerHTML = "Each field must have at least 2 characters.";
        return false;
    }
    
    
        return true;
    
   
}