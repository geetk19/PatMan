function validateform(){  
var name=document.myform.drname.value;  
var phno=document.myform.Cont.value;  
  
if (name==null || name==""){  
  alert("Check your name");  
  return false;  
}else if(phno.length!=10 || isNaN(phno)){  
  alert("Incorrect Phone Number");  
  return false;  
  }  
}  