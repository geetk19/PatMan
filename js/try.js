function validate() 
{ 
var password = getEleme 


/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
if(inputtxt.value.match(password)) 
{ 
alert('Correct, try another...')
return true;
}
else
{ 
alert('Wrong...!')
return false;
}
} 