            <footer class="page-footer orange darken-2">
            <div class="">
                <div class="row">
                    <div class="col l6 m6 offset-m3 s12">
                        <h5 style="font-weight: bold;">Download Our App From Playstore</h5>
                        <img src="src/img/playstore.png" alt="" width="300">
                    </div>
                    <div class="col l3 m6 s6">
                        <h5>Sitemap</h5>
                        <ul>
                            <li><a class="white-text" href="#">About</a></li>
                            <li><a class="white-text" href="#">Teams</a></li>
                            <li><a class="white-text" href="#">App</a></li>
                        </ul>
                    </div>
                    <div class="col s6 m6 l3">
                        <h5>Connect</h5>
                        <ul>
                            <li><a href="" class="white-text">Facebook</a></li>
                            <li><a href="" class="white-text">Twitter</a></li>
                            <li><a href="" class="white-text">Instagram</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- starting footer copyright section -->
            <div class="footer-copyright">
                <div class="container">
                    &copy; Famblah 2019-2020 | All Right Reserved.
                    <span class=" right white-text">Design By <a href="http://socialcodia.com" class="white-text">Social Codia</a></span>
                </div>
            </div>
        </footer>


</body>
<script src="js/jquery-3.4.1.min.js"></script>

  <!-- Compiled and minified JavaScript -->
  <script src="js/materialize.min.js"></script>

   <!-- Script For Displaying Post's Selected Image Before Uploading -->
 <script>
         function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#feedImage')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

  <script>
    $(document).ready(function(){
    $('.tooltipped').tooltip();
    $('.dropdown-trigger').dropdown();
    $('.tabs').tabs();
    $('.collapsible').collapsible();
    $('.sidenav').sidenav();
    
  });
  </script>

<script type="text/javascript">
    function doLike(){
    var feedId = document.getElementById('feedId').value;
    // var sender_id =document.getElementById('sender_id').value;
    // var reciever_id = document.getElementById('reciever_id').value;
    $.ajax({
            type:"post",
            url:"sendchat.php",
            data: 
            {  
               'feedId' : feedId
            },
            });
            return false;
     }
    </script>
  
</html>