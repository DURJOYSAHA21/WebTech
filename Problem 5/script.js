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

