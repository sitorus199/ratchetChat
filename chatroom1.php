<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbox</title>
    
    <!-- Custom CSS -->
    <link href="css-js/style.css" rel="stylesheet" rel="stylesheet" type="text/css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="vendor-front/jquery/jquery.min.js"></script>
    <script src="vendor-front/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor-front/jquery-easing/jquery.easing.min.js"></script>

    <script type="text/javascript" src="vendor-front/parsley/dist/parsley.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    

</head>
<body>

    <?php 
        
     ?>
    <div class="fab-container position-fixed bottom-0 end-0 me-3 mb-3 " style="z-index: 1000;">
        <button 
        id="btn-toggle-chat"
        class="btn btn-green rounded-circle shadow-lg" 
        style="width: 60px; height: 60px;background-color: #00A389;" 
        type="button" 
        data-bs-toggle="collapse" 
        data-bs-target="#collapseExample" 
        aria-expanded="false" 
        aria-controls="collapseExample">
            <img id="btn-message" src="assets/Icon Message.svg">
            <img id="btn-chevron" src="assets/chevron-down.svg" style="display: none;">
        </button>
    </div>

    <div class="collapse position-fixed end-0 me-3 mb-3" id="collapseExample" style="z-index: 1000;bottom: 5rem;">
        <div class="card shadow-lg border-0" style="width: 400px; height: 515px; border-radius: 1rem;">
            <div class="card-header py-4 px-4" style="background-color: #00A389; border-top-left-radius: 1rem;border-top-right-radius: 1rem;">
                <div class="row justify-content-center g-0">
                    <div class="col-2 align-content-center">           
                        <img class="rounded-circle text-center" src="assets/avatar.png" alt="" width="50px">
                    </div>
                    <div class="col-10">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-bold text-white" style="font-size: 1.2rem;">Slamet Rahardjo</span>
                            </div>
                            <div class="col-12">
                                <span class="text-white" style="font-size: .9rem;">Online</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form nama -->
            <div id="form-nama" class="card-body" style="overflow-x: hidden; overflow-y: scroll;">
                <div class="row g-0">
                    <div class="mb-3">
                        <label for="formNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="formNama" value="asdasd" placeholder="Nama Anda">
                      </div>
                      <div class="mb-3">
                        <label for="formEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" id="formEmail" placeholder="example@email.com">
                      </div>
                </div>
                <!-- <div class="row g-0 ">
                    <button id="btn-form-name" class="position-absolute bottom-0 start-50 translate-middle-x btn btn-send border-0 text-white fw-bold py-3" id="btn-send" style="background-color: #00A389; border-radius: 0rem 0rem 1rem 1rem">
                        Kirim
                    </button>
                </div> -->
            </div>

            <!-- conversation -->
            <div id="conversation" class="card-body" style="overflow-x: hidden; overflow-y: scroll; display: none;">
                <div class="row g-0" id="messages_area" >
                    <!-- isi pesan -->
                </div>
            </div>

            <!-- form nama -->
            <div id="btn-form-name" class="footer px-3 py-3" style="background-color: #F5F4F7; border-bottom-left-radius: 1rem;border-bottom-right-radius: 1rem;">
                <div class="row g-0 ">
                    <button class="btn-green position-absolute bottom-0 start-50 translate-middle-x btn btn-send border-0 text-white fw-bold py-3" id="btn-send" style="background-color: #00A389; border-radius: 0rem 0rem 1rem 1rem">
                        Kirim
                    </button>
                </div>
            </div>
           
            <div id="conversation-footer" class="footer px-3 py-3" style="background-color: #F5F4F7; border-bottom-left-radius: 1rem;border-bottom-right-radius: 1rem;">
                <!-- conversation -->
                <!-- <form> -->
                    <form method="post" id="chat_form" data-parsley-errors-container="#validation_error">
                        <div class="row g-0">
                            <div class="col-8 pe-3">
                                <textarea class="chat-text-area form-control border-0 me-3" 
                                id="chat_message" name="chat_message"
                                rows="1" placeholder="Tulis pesan Anda..."
                                style="background-color:#F5F4F7"></textarea>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-gif p-1" >
                                    <img src="assets/gif.svg" >
                                </button>
                                <button class="btn btn-emoticon p-1" >
                                    <img src="assets/emoticon.svg" >
                                </button>
                                <button class="btn btn-file p-1" >
                                    <img src="assets/file.svg" >
                                </button>
                                <button type="submit" name="send" id="send" class="btn btn-send p-1"  >
                                    <img src="assets/btnSend.svg" >
                                </button>
                            </div>
                        </div>
                    </form>
                    <input type="hidden" name="login_user_id" id="login_user_id" value="<?php $id; ?>" />
                <!-- </form> -->
            </div>
        </div>
      </div>
 
    <script > 

        // Koneksi Websocket
        $(document).ready(function(){

            var conn = new WebSocket('ws://localhost:8081');
            conn.onopen = function(e) {
                console.log("Connection established!");
            };

            conn.onmessage = function(e) {
                console.log(e.data);

                var data = JSON.parse(e.data);

                var row_class = '';

                var background_class = '';

                if(data.from == 'Me')
                {
                    // row_class = 'row justify-content-end';
                    row_class = 'float-end';
                    bg = '#00A389';
                    text= 'text-white';
                    time='text-white-50'
                    background_class = 'alert-info';

                }
                else
                {
                    data.from = 'You';
                    //row_class = 'row justify-content-start';
                    background_class = 'text-dark alert-light';
                    bg = '#F5F4F7';
                    text= ' ';
                    time='text-black-50'
                    row_class = 'float-start';
                }


                var html_data = "<div class='col-12 mb-3'><span class='px-3 pt-2 pb-4 chat-bubble "+row_class+" "+text+" position-relative' style='background-color: "+bg+"; min-width: 20%; max-width: 80%; border-radius: 1rem!important;'>"+data.msg+"<span class='"+time+" position-absolute bottom-0 end-0 me-2 mb-1' style='font-size: .8rem;'>"+moment().format('LT')+"</span></span></div>"

                //var html_data = "<div class='"+row_class+"'><div class='col-sm-10'><div class='shadow-sm alert "+background_class+"'><b>"+data.from+" - </b>"+data.msg+"<br /><div class='text-right'><small><i>"+moment().format('LT')+"</i></small></div></div></div></div>";

                $('#messages_area').append(html_data);

                $("#chat_message").val("");
            };

            // $('#chat_form').parsley();

            // Proses Pengiriman Pesan

            $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

            $('#chat_form').on('submit', function(event){

                event.preventDefault();

                if($('#chat_form').parsley().isValid())
                {

                    var user_id = $('#login_user_id').val();

                    var message = $('#chat_message').val();

                    var data = {
                        userId : user_id,
                        msg : message
                    };
                    conn.send(JSON.stringify(data));
                    // conn.send('Halo');

                    $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

                }
            });

        });

        function sendChat() {
            event.preventDefault();
            let message=$('.chat-text-area').val() 
            console.log(message)
            let elements=`<div class="col-12 mb-3">
                            <span class="px-3 pt-2 pb-4 chat-bubble float-end text-white position-relative" style="background-color: #00A389; min-width: 20%; max-width: 80%; border-radius: 1rem!important;">
                                  ${message}
                                  <span class="text-white-50 position-absolute bottom-0 end-0 me-2 mb-1" style="font-size: .8rem;">
                                        ${moment().format('LT')}
                                  </span>
                            </span>
                      </div>`
            $("#messages_area").append(elements);
            message = ''
            $("#chat_message").val('')

        }
        $('#chat_message').keypress(function (e) {
          if (e.which == 13) {
            $(this).blur();
            sendChat()
          }
          
          // $(this).focus();
          // $(this).val('')
          
        });

        
    </script>
    <script src="css-js/chat.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <!-- moment Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>