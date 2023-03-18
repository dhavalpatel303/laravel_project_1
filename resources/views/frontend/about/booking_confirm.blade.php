<button id="hello" type="button" class="btn btn-primary btn-md mt-4">hello</button> 

<script>
      $(document).ready(function(){
                     
                     $('#hello').click(function()
                     {
                       
                        var d = new Date();          
                        
                        var n = d.toLocaleString([], { hour12: true});
                        
                        document.getElementById("demo2").innerHTML = n;
                       
                     });
            });
             
    
</script>