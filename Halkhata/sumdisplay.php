<HTML>
      <HEAD>
        <TITLE>Sum</TITLE>

        <script type="text/javascript">
          function sum()
          {
             var num1 = document.myform.number1.value;
             var num2 = document.myform.number2.value;
             var sum = parseInt(num1) + parseInt(num2);
             document.getElementById('add').value = sum;
			 alert(sum);
          }
        </script>
      </HEAD>

      <BODY>
        <FORM NAME="myform">
          <INPUT TYPE="text" NAME="number1" VALUE=""> + 
          <INPUT TYPE="text" NAME="number2" VALUE="">
          <INPUT TYPE="button" NAME="button" Value="=" onClick="sum()">
          <INPUT TYPE="text" ID="add" NAME="result" VALUE="">
        </FORM>
   
      </BODY>
</HTML>