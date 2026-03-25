    var item=document.getElementById("Item")
    var price=document.getElementById("price")
    var quantity=document.getElementById("quantity")

function addtoshop(event)
{
  event.preventDefault();
  var tables =document.getElementsByTagName("table")
  var table=tables[0];


  var newrow=document.createElement("tr");
  var td1=document.createElement('td')
  td1.innerHTML=item.value
  newrow.appendChild(td1);
  var td2=document.createElement('td')
  td2.innerHTML=price.value
  newrow.appendChild(td2);
  var td3=document.createElement('td')
  td3.innerHTML=quantity.value
  newrow.appendChild(td3);
  table.appendChild(newrow);

    item.value=""
    price.value=""
    quantity.value=""
    dropdown();
}

function dropdown()
{
  var tables =document.getElementsByTagName("table")
  var table=tables[0];
  

  var dropdown=document.getElementById('buy')
  dropdown.innerHTML="";

  for(var i=1; i<table.rows.length; i++)
  {
    var row=table.rows[i]
    var itemname=row.cells[0].innerText;
    var itemprice=row.cells[1].innerText;

    var op=document.createElement('option')
    op.value=i;
    op.innerHTML=itemname+"- $"+ itemprice;
    op.dataset.price=itemprice;
    dropdown.appendChild(op)
  }
}
var total=0;
function addtocart()
{
    var dropdown=document.getElementById("buy");
    var quan=document.getElementById("quan");

    var selected=dropdown.selectedOptions[0];

    var item=selected.innerText.split("-")[0];
    var price=Number(selected.dataset.price)
    var quantity=Number(quan.value);

    var tables=document.getElementsByTagName("table")
    var table=tables[0];
    var rowind=Number(selected.value);
    var avail=Number(table.rows[rowind].cells[2].innerText);

    if(quantity>avail)
    {
        alert("We don't have that much")
        return;
    }
    if(quantity<1)
    {
        alert("Enter valid quantity");
        return;
    }

    table.rows[rowind].cells[2].innerText=avail-quantity;
    var carts=document.getElementById("carts");
    var newrow=document.createElement("tr");
    var td1=document.createElement("td");
    td1.innerHTML=item;
    newrow.appendChild(td1);
    var td2=document.createElement("td");
    td2.innerHTML=quantity;
    newrow.appendChild(td2);
    var td3=document.createElement("td");
    td3.innerHTML=price;
    newrow.appendChild(td3);
    var td4=document.createElement("td");
    td4.innerHTML=price*quantity;
    newrow.appendChild(td4);
    carts.appendChild(newrow);


    var itemtotal=quantity*price;
    total+=itemtotal;

    document.getElementById('total').innerHTML=`<h3>Your Total bill is ${total}</h3>`
    quan.value="";



}

