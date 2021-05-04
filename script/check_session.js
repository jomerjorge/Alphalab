
function check_session()
{
$.ajax({
  url:"/alphalab/api/session/check_session.php",
  method:"POST", 
  success:function(data)
  {
    console.log(data);
    if(data == 1)
    {
      alert('Please Log In First!');  
      window.location.href="login.php";
    }
    
  }
})
}